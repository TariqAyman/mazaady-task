<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Repositories\EmployeeRepository;

class EmployeeService extends BaseService
{
    public function __construct(private readonly EmployeeRepository $repository)
    {
    }

    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }
}
