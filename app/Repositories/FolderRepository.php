<?php

namespace App\Repositories;

use App\Models\Folder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FolderRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Folder::class;
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->getModel()::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate($perPage);
    }
}
