<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (require database_path('data/exercises.php') as $exercise) {
            Exercise::updateOrCreate(
                ['user_id' => null, 'name' => $exercise['name']],
                ['metrics' => $exercise['metrics']],
            );
        }
    }
}
