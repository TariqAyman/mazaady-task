<?php

namespace App\Services;

use App\Models\Folder;
use App\Models\Note;
use App\Repositories\BaseRepository;
use App\Repositories\FolderRepository;
use App\Repositories\NoteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class NoteService extends BaseService
{
    public function __construct(private readonly NoteRepository $repository)
    {
    }

    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    public function all($filter = []): Collection
    {
        return $this->getRepository()->all($filter);
    }

    public function paginate($perPage = 10): LengthAwarePaginator
    {
        return $this->getRepository()->paginate($perPage);
    }

    public function create(array $data): Model
    {
        if (Arr::has($data, 'pdf_path')) {
            $path = Storage::disk('public')
                ->put('pdf', $data['pdf_path'], 'public');
            $data['pdf_path'] = $path;
        }

        return parent::create($data);
    }

  public function update(Model $id, array $data): bool
  {
      if (Arr::has($data, 'pdf_path')) {
          $path = Storage::disk('public')
              ->put('pdf', $data['pdf_path'], 'public');
          $data['pdf_path'] = $path;
      }

      return parent::update($id, $data);
  }
}
