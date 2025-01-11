<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Repositories\DepartmentRepository;

class DepartmentService extends BaseService
{
    public function __construct(private readonly DepartmentRepository $repository)
    {
    }

    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }
}
