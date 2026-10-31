<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StartWorkoutSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'workout_id' => [
                'nullable',
                'integer',
                Rule::exists('workouts', 'id')->where('user_id', $this->user()->id),
            ],
            'notes' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
