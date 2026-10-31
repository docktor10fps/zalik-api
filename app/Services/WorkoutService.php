<?php

namespace App\Services;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class WorkoutService
{
    public function list(User $user): Collection
    {
        return $user->workouts()->with('workoutExercises.exercise')->latest()->get();
    }

    public function create(User $user, array $data): Workout
    {
        return DB::transaction(function () use ($user, $data) {
            $workout = $user->workouts()->create(['name' => $data['name']]);

            $this->saveExercises($workout, $data['exercises']);

            return $workout->load('workoutExercises.exercise');
        });
    }

    public function update(Workout $workout, array $data): Workout
    {
        return DB::transaction(function () use ($workout, $data) {
            $workout->update(['name' => $data['name']]);

            $workout->workoutExercises()->delete();

            $this->saveExercises($workout, $data['exercises']);

            return $workout->load('workoutExercises.exercise');
        });
    }

    public function delete(Workout $workout): void
    {
        $workout->delete();
    }

    private function saveExercises(Workout $workout, array $exercises): void
    {
        foreach (array_values($exercises) as $index => $exercise) {
            $workout->workoutExercises()->create([
                'exercise_id'  => $exercise['exercise_id'],
                'position'     => $index + 1,
                'planned_sets' => $exercise['planned_sets'],
            ]);
        }
    }
}
