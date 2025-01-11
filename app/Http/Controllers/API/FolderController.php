<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\StoreFolderRequest;
use App\Http\Requests\Folder\UpdateFolderRequest;
use App\Models\Folder;
use App\Services\FolderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FolderController extends Controller
{
    public function __construct(private readonly FolderService $service)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $folders = $this->service->paginate($request->integer('per_page', 5));

        return response()->json($folders);
    }

    public function store(StoreFolderRequest $request): JsonResponse
    {
        $folder = $this->service->create($request->validated());

        return response()->json($folder, 201);
    }

    public function show(Folder $folder): JsonResponse
    {
        Gate::authorize('view', $folder);

        return response()->json($folder);
    }

    public function update(UpdateFolderRequest $request, Folder $folder): JsonResponse
    {
        Gate::authorize('update', $folder);

        $this->service->update($folder, $request->validated());
        return response()->json($folder);
    }

    public function destroy(Folder $folder): JsonResponse
    {
        Gate::authorize('delete', $folder);

        $this->service->delete($folder);
        return response()->json(null, 204);
    }
}
