<?php

namespace App\Http\Requests;

use App\Models\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSessionSetRequest extends FormRequest
{
    public function rules(): array
    {
        $exercise = Exercise::visibleTo($this->user())->find($this->integer('exercise_id'));

        return [
            'exercise_id' => ['required', 'integer', Rule::in($exercise ? [$exercise->id] : [])],
            ...($exercise?->metricRules() ?? []),
        ];
    }
}
