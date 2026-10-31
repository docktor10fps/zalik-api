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
        if ($this->metricsChanged($exercise, $data['metrics']) && $exercise->sessionSets()->exists()) {
            abort(409, 'Metrics cannot be changed once the exercise has results');
        }

        $exercise->update($data);

        return $exercise;
    }

    public function delete(Exercise $exercise): void
    {
        if ($exercise->sessionSets()->exists() || $exercise->workoutExercises()->exists()) {
            abort(409, 'Exercise is used in a workout or has results');
        }

        $exercise->delete();
    }

    private function metricsChanged(Exercise $exercise, array $metrics): bool
    {
        return array_diff($exercise->metrics, $metrics) || array_diff($metrics, $exercise->metrics);
    }
}
