<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $appends = ['highest_salary'];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_employee');
    }

    /**
     * Get the highest salary among all departments this employee belongs to.
     */
    public function getHighestSalaryAttribute()
    {
        // If the employee has departments, get the maximum salary among them
        return $this->departments()
            ->join('salaries', 'departments.salary_id', '=', 'salaries.id')
            ->max('salaries.amount');
    }

    public function salaries()
    {
        return $this->hasManyThrough(
            Salary::class,
            Department::class,
            'id',
            'id',
            'id',
            'salary_id'
        );
    }
}
