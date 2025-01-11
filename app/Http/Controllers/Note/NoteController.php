<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\StoreFolderRequest;
use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Models\Folder;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function __construct(private readonly NoteService $service)
    {
    }

    public function list()
    {
        $notes = $this->service->all(['visibility' => 'shared']);

        return view('notes.index-global', compact('notes'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Folder $folder)
    {
        Gate::authorize('view', $folder);

        $notes = $this->service->all(['folder_id' => $folder->id]);

        return view('notes.index', compact('folder', 'notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Folder $folder)
    {
        Gate::authorize('view', $folder);

        return view('notes.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Folder $folder, StoreNoteRequest $request)
    {
        Gate::authorize('view', $folder);

        $data = $request->validated();
        $data['folder_id'] = $folder->id;

        $this->service->create($data);

        return redirect()->route('notes.index', $folder)
            ->with('success', 'Note created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder, Note $note)
    {
        Gate::authorize('update', $folder);

        return view('notes.edit', compact('folder', 'note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Folder $folder, Note $note)
    {
        Gate::authorize('update', $folder);

        $this->service->update($note, $request->validated());

        return redirect()->route('notes.index', $folder)
            ->with('success', 'Note updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder, Note $note)
    {
        Gate::authorize('update', $folder);
        $this->service->delete($note);
        return redirect()->route('notes.index', $folder)
            ->with('success', 'Note deleted successfully!');
    }
}
