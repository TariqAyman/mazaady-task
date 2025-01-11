<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    /**
     * @return Model
     */
    abstract public function getModel(): string;

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->getModel()::query()->latest()->paginate($perPage);
    }

    /**
     * Retrieve all employees.
     */
    public function all(): Collection
    {
        return $this->getModel()::query()->latest()->get();
    }

    public function create(array $data): Model
    {
        return $this->getModel()::query()->create($data);
    }

    /**
     * @param Model $id
     * @param array $data
     * @return bool
     */
    public function update(Model $id, array $data): bool
    {
        return $id->update($data);
    }

    /**
     * @param Model $id
     * @return bool
     */
    public function delete(Model $id): bool
    {
        return $id->delete();
    }
}
