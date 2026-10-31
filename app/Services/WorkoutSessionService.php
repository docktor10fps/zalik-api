<?php

namespace App\Services;

use App\Models\SessionSet;
use App\Models\User;
use App\Models\WorkoutSession;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WorkoutSessionService
{
    public function list(User $user): LengthAwarePaginator
    {
        return $user->workoutSessions()
            ->withCount('sets')
            ->latest('started_at')
            ->paginate();
    }

    public function start(User $user, array $data): WorkoutSession
    {
        return $user->workoutSessions()->create([
            ...$data,
            'started_at' => now(),
        ]);
    }

    public function update(WorkoutSession $workoutSession, array $data): WorkoutSession
    {
        $workoutSession->update($data);

        return $workoutSession;
    }

    public function finish(WorkoutSession $workoutSession): WorkoutSession
    {
        if (!$workoutSession->finished_at) {
            $workoutSession->update(['finished_at' => now()]);
        }

        return $workoutSession;
    }

    public function delete(WorkoutSession $workoutSession): void
    {
        $workoutSession->delete();
    }

    public function addSet(WorkoutSession $workoutSession, array $data): SessionSet
    {
        return $workoutSession->sets()->create($data);
    }

    public function updateSet(SessionSet $sessionSet, array $data): SessionSet
    {
        $sessionSet->update($data);

        return $sessionSet;
    }

    public function deleteSet(SessionSet $sessionSet): void
    {
        $sessionSet->delete();
    }
}
