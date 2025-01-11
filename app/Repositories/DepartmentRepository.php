<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Employee;

class DepartmentRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Department::class;
    }
}
