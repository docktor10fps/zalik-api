<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'position'     => $this->position,
            'planned_sets' => $this->planned_sets,
            'exercise'     => ExerciseResource::make($this->whenLoaded('exercise')),
        ];
    }
}
