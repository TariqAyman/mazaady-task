<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create distinct salary amounts
        $salaryAmounts = [1000, 2000, 3000, 4000, 5000];

        foreach ($salaryAmounts as $amount) {
            Salary::create(['amount' => $amount]);
        }
    }
}
