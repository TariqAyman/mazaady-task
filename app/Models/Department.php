<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'salary_id'
    ];

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'department_employee');
    }
}
