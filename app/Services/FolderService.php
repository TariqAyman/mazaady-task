<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\FolderRepository;
use Illuminate\Database\Eloquent\Model;

class FolderService extends BaseService
{
    public function __construct(private readonly FolderRepository $repository)
    {
    }

    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    public function create(array $data): Model
    {
        $data['user_id'] = auth()->id();

        return parent::create($data);
    }
}
