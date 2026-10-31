<?php

namespace App\Policies;

use App\Models\SessionSet;
use App\Models\User;

class SessionSetPolicy
{
    public function update(User $user, SessionSet $sessionSet): bool
    {
        return $sessionSet->workoutSession->user_id === $user->id;
    }

    public function delete(User $user, SessionSet $sessionSet): bool
    {
        return $sessionSet->workoutSession->user_id === $user->id;
    }
}
