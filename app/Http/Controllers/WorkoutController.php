<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkoutRequest;
use App\Http\Resources\WorkoutResource;
use App\Models\Workout;
use App\Services\WorkoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkoutController extends Controller
{
    public function __construct(private readonly WorkoutService $workoutService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'workouts' => WorkoutResource::collection($this->workoutService->list($request->user())),
        ]);
    }

    public function store(WorkoutRequest $request): JsonResponse
    {
        $workout = $this->workoutService->create($request->user(), $request->validated());

        return response()->json(['workout' => WorkoutResource::make($workout)], 201);
    }

    public function show(Workout $workout): JsonResponse
    {
        Gate::authorize('view', $workout);

        return response()->json([
            'workout' => WorkoutResource::make($workout->load('workoutExercises.exercise')),
        ]);
    }

    public function update(WorkoutRequest $request, Workout $workout): JsonResponse
    {
        Gate::authorize('update', $workout);

        $workout = $this->workoutService->update($workout, $request->validated());

        return response()->json(['workout' => WorkoutResource::make($workout)]);
    }

    public function destroy(Workout $workout): JsonResponse
    {
        Gate::authorize('delete', $workout);

        $this->workoutService->delete($workout);

        return response()->json(['message' => 'Workout deleted']);
    }
}
