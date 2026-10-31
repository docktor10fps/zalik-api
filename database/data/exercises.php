<?php

use App\Enums\ExerciseMetricEnum as Metric;

$strength = [Metric::WeightKg, Metric::Reps];
$bodyweight = [Metric::Reps];
$static = [Metric::DurationSeconds];
$cardio = [Metric::DistanceM, Metric::DurationSeconds];

return [
    ['name' => 'Жим лежачи', 'metrics' => $strength],
    ['name' => 'Жим гантелей лежачи', 'metrics' => $strength],
    ['name' => 'Жим стоячи', 'metrics' => $strength],
    ['name' => 'Присідання зі штангою', 'metrics' => $strength],
    ['name' => 'Станова тяга', 'metrics' => $strength],
    ['name' => 'Тяга штанги в нахилі', 'metrics' => $strength],
    ['name' => 'Тяга верхнього блока', 'metrics' => $strength],
    ['name' => 'Жим ногами', 'metrics' => $strength],
    ['name' => 'Згинання рук зі штангою', 'metrics' => $strength],
    ['name' => 'Розгинання рук на блоці', 'metrics' => $strength],
    ['name' => 'Підтягування з вагою', 'metrics' => $strength],
    ['name' => 'Віджимання на брусах з вагою', 'metrics' => $strength],

    ['name' => 'Підтягування', 'metrics' => $bodyweight],
    ['name' => 'Віджимання', 'metrics' => $bodyweight],
    ['name' => 'Віджимання на брусах', 'metrics' => $bodyweight],
    ['name' => 'Присідання', 'metrics' => $bodyweight],
    ['name' => 'Випади', 'metrics' => $bodyweight],
    ['name' => 'Підйом ніг у висі', 'metrics' => $bodyweight],
    ['name' => 'Вихід силою', 'metrics' => $bodyweight],

    ['name' => 'Планка', 'metrics' => $static],
    ['name' => 'Куточок', 'metrics' => $static],
    ['name' => 'Стійка на руках', 'metrics' => $static],
    ['name' => 'Передній вис', 'metrics' => $static],
    ['name' => 'Задній вис', 'metrics' => $static],
    ['name' => 'Планш', 'metrics' => $static],

    ['name' => 'Біг', 'metrics' => $cardio],
    ['name' => 'Велосипед', 'metrics' => $cardio],
];
