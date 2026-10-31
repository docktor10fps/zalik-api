<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'description', 'metrics'])]
class Exercise extends Model
{
    protected function casts(): array
    {
        return [
            'metrics' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workoutExercises(): HasMany
    {
        return $this->hasMany(WorkoutExercise::class);
    }

    public function scopeVisibleTo(Builder $query, User $user): void
    {
        $query->where(fn ($query) => $query
            ->whereNull('user_id')
            ->orWhere('user_id', $user->id));
    }
}
