<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can view the folder.
     */
    public function view(User $user, Folder $folder): bool
    {
        return $folder->user_id === $user->id;
    }

    /**
     * Determine if the user can create folders.
     */
    public function create(User $user): bool
    {
        // Maybe all authenticated users can create folders
        return $user != null;
    }

    /**
     * Determine if the user can update the folder.
     */
    public function update(User $user, Folder $folder): bool
    {
        // Only the folder owner can update
        return $folder->user_id === $user->id;
    }

    /**
     * Determine if the user can delete the folder.
     */
    public function delete(User $user, Folder $folder): bool
    {
        return $folder->user_id === $user->id;
    }
}
