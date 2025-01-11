<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Models\Folder;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function __construct(private readonly NoteService $service)
    {
    }

    public function index(Folder $folder): JsonResponse
    {
        Gate::authorize('view', $folder);

        $notes = $this->service->all(['folder_id' => $folder->id]);

        return response()->json($notes);
    }

    public function store(Folder $folder, StoreNoteRequest $request): JsonResponse
    {
        Gate::authorize('view', $folder);

        $data = $request->validated();
        $data['folder_id'] = $folder->id;

        $note = $this->service->create($data);

        return response()->json($note, 201);
    }

    public function show(Folder $folder, Note $note): JsonResponse
    {
        Gate::authorize('update', $folder);

        return response()->json($note);
    }

    public function update(UpdateNoteRequest $request, Folder $folder, Note $note): JsonResponse
    {
        Gate::authorize('update', $folder);

        $this->service->update($note, $request->validated());

        return response()->json($note);
    }

    public function destroy(Folder $folder, Note $note): JsonResponse
    {
        Gate::authorize('update', $folder);
        $this->service->delete($note);

        return response()->json(null, 204);
    }

    public function showPublic(): JsonResponse
    {
        $notes = $this->service->all(['visibility' => 'shared']);

        return response()->json($notes);
    }
}
