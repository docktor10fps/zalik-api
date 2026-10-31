<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ExerciseService
{
    public function list(User $user): Collection
    {
        return Exercise::visibleTo($user)->orderBy('name')->get();
    }

    public function create(User $user, array $data): Exercise
    {
        return $user->exercises()->create($data);
    }

    public function update(Exercise $exercise, array $data): Exercise
    {
        $exercise->update($data);

        return $exercise;
    }

    public function delete(Exercise $exercise): void
    {
        $exercise->delete();
    }
}
