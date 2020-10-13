<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\file  $file
     * @return mixed
     */
    public function access(User $user, File $file)
    {
        return $user->currentTeam->id === $file->investigation->team_id;
    }
}
