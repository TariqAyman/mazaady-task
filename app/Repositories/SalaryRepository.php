<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SalaryRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Salary::class;
    }

    public function getEmployeesHighestSalary(int $nth): Collection
    {
        $departments = Department::join('salaries', 'departments.salary_id', '=', 'salaries.id')
            ->orderBy('salaries.amount', 'desc')
            ->limit($nth)
            ->get(['departments.id as id'])
            ->pluck('id');

        return Employee::query()
            ->with('departments.salary')
            ->whereHas('departments', function (Builder $query) use ($departments) {
                $query->whereIn('departments.id', $departments);
            })
            ->get();
    }
}
