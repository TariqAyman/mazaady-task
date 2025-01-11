<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salaries = Salary::all();

        // Example: create a few departments, randomly assigning salaries
        $depData = [
            ['name' => 'HR'],
            ['name' => 'Engineering'],
            ['name' => 'Marketing'],
            ['name' => 'Finance'],
        ];

        foreach ($depData as $data) {
            Department::create([
                'name' => $data['name'],
                'salary_id' => $salaries->random()->id,
            ]);
        }
    }
}
