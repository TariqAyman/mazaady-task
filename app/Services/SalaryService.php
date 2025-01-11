<?php

namespace App\Services;

use App\Models\Department;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Repositories\SalaryRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SalaryService extends BaseService
{
    public function __construct(private readonly SalaryRepository $repository)
    {
    }

    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    /**
     * Return employees who have the N-th highest salary.
     *
     */
    public function getEmployeesHighestSalary(int $nth): Collection
    {
        return $this->repository->getEmployeesHighestSalary($nth);
    }
}
