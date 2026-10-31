<?php

namespace App\Enums;

enum ExerciseMetricEnum: string
{
    case Reps = 'reps';
    case WeightKg = 'weight_kg';
    case DistanceM = 'distance_m';
    case DurationSeconds = 'duration_seconds';
}
