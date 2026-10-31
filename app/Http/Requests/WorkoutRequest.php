<?php

namespace App\Http\Requests;

use App\Models\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkoutRequest extends FormRequest
{
    public function rules(): array
    {
        $visibleExerciseIds = Exercise::visibleTo($this->user())->pluck('id');

        return [
            'name'                     => ['required', 'string', 'max:255'],
            'exercises'                => ['required', 'list', 'min:1'],
            'exercises.*.exercise_id'  => ['required', 'integer', Rule::in($visibleExerciseIds)],
            'exercises.*.planned_sets' => ['required', 'integer', 'min:1', 'max:50'],
        ];
    }
}
