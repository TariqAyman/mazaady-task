<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class EmployeeRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Employee::class;
    }

    public function create($data): Employee
    {
        $employee = parent::create(Arr::only($data, ['name']));

        $employee->departments()->sync(Arr::get($data, 'departments'));

        return $employee;
    }

    public function update(Model $model, $data): bool
    {
        $updated = parent::update($model, Arr::only($data, ['name']));

        $model->departments()->sync(Arr::get($data, 'departments'));

        return $updated;
    }
}
