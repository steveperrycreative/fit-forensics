<?php

namespace App\Policies;

use App\Models\Investigation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class InvestigationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Investigation  $investigation
     * @return mixed
     */
    public function access(User $user, Investigation $investigation)
    {
        return $user->currentTeam->id === $investigation->team_id;
    }

    public function create(User $user)
    {
        return $user->ownsTeam($user->currentTeam)
            ? Response::allow()
            : Response::deny('You do not own your current team.');
    }
}
