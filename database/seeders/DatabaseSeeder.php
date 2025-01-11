<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            SalariesTableSeeder::class,
            EmployeesTableSeeder::class,
            DepartmentsTableSeeder::class,
        ]);

        // Attach employees to departments randomly
        Employee::all()
            ->each(function ($employee) {
                $depIds = Department::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $employee->departments()->sync($depIds);
            });
    }
}
