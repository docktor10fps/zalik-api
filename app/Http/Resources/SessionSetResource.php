<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionSetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'exercise_id'      => $this->exercise_id,
            'reps'             => $this->reps,
            'weight_kg'        => $this->weight_kg,
            'distance_m'       => $this->distance_m,
            'duration_seconds' => $this->duration_seconds,
            'exercise'         => ExerciseResource::make($this->whenLoaded('exercise')),
        ];
    }
}
