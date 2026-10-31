<?php

namespace App\Http\Requests;

use App\Enums\ExerciseMetricEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExerciseRequest extends FormRequest
{
    public function rules(): array
    {
        $exercise = $this->route('exercise');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('exercises', 'name')
                    ->where('user_id', $exercise ? $exercise->user_id : $this->user()->id)
                    ->ignore($exercise),
            ],
            'description' => ['nullable', 'string', 'max:2000'],
            'metrics'     => ['required', 'list', 'min:1'],
            'metrics.*'   => ['required', 'distinct', Rule::enum(ExerciseMetricEnum::class)],
        ];
    }
}
