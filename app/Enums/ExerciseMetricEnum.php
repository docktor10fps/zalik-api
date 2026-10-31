<?php

namespace App\Enums;

enum ExerciseMetricEnum: string
{
    case Reps = 'reps';
    case WeightKg = 'weight_kg';
    case DistanceM = 'distance_m';
    case DurationSeconds = 'duration_seconds';

    public function rules(): array
    {
        return match ($this) {
            self::WeightKg => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:9999.99'],
            default => ['required', 'integer', 'min:1', 'max:1000000'],
        };
    }
}
