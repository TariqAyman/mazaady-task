<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\StoreFolderRequest;
use App\Http\Requests\Folder\UpdateFolderRequest;
use App\Models\Folder;
use App\Services\FolderService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function __construct(private readonly FolderService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $folders = $this->service->paginate($request->integer('per_page', 5));

        return view('folders.index', compact('folders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('folders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFolderRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('folders.index')
            ->with('success', 'Folder created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder)
    {
        Gate::authorize('view', $folder);

        return view('folders.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        Gate::authorize('update', $folder);

        $this->service->update($folder, $request->validated());

        return redirect()->route('folders.index')
            ->with('success', 'Folder updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        Gate::authorize('delete', $folder);

        $this->service->delete($folder);

        return redirect()->route('folders.index')
            ->with('success', 'Folder deleted successfully!');
    }
}
