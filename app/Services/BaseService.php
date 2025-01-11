<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseService
{
    abstract public function getRepository(): BaseRepository;

    public function all($filter = []): Collection
    {
        return $this->getRepository()->all();
    }

    public function paginate($perPage = 10): LengthAwarePaginator
    {
        return $this->getRepository()->paginate($perPage);
    }

    public function create(array $data): Model
    {
        return $this->getRepository()->create($data);
    }

    public function update(Model $id, array $data): bool
    {
        return $this->getRepository()->update($id, $data);
    }

    public function delete(Model $id): void
    {
        $this->getRepository()->delete($id);
    }
}
