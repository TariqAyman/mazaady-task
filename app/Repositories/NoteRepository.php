<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class NoteRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Note::class;
    }

    public function all($filter = []): Collection
    {
        $all = $this->getModel()::query();

        if (Arr::get($filter, 'filter_id')) {
            $all->where('filter_id', $filter['filter_id']);
        }

        if (Arr::get($filter, 'visibility')) {
            $all->where('visibility', $filter['visibility']);
        }

        return $all->get();
    }
}
