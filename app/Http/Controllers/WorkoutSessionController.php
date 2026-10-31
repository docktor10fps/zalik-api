<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartWorkoutSessionRequest;
use App\Http\Requests\UpdateWorkoutSessionRequest;
use App\Http\Resources\WorkoutSessionResource;
use App\Models\WorkoutSession;
use App\Services\WorkoutSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class WorkoutSessionController extends Controller
{
    public function __construct(private readonly WorkoutSessionService $workoutSessionService)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return WorkoutSessionResource::collection($this->workoutSessionService->list($request->user()));
    }

    public function store(StartWorkoutSessionRequest $request): JsonResponse
    {
        $workoutSession = $this->workoutSessionService->start($request->user(), $request->validated());

        return response()->json(['workout_session' => WorkoutSessionResource::make($workoutSession)], 201);
    }

    public function show(WorkoutSession $workoutSession): JsonResponse
    {
        Gate::authorize('view', $workoutSession);

        return response()->json([
            'workout_session' => WorkoutSessionResource::make($workoutSession->load('sets.exercise')),
        ]);
    }

    public function update(UpdateWorkoutSessionRequest $request, WorkoutSession $workoutSession): JsonResponse
    {
        Gate::authorize('update', $workoutSession);

        $workoutSession = $this->workoutSessionService->update($workoutSession, $request->validated());

        return response()->json(['workout_session' => WorkoutSessionResource::make($workoutSession)]);
    }

    public function finish(WorkoutSession $workoutSession): JsonResponse
    {
        Gate::authorize('update', $workoutSession);

        $workoutSession = $this->workoutSessionService->finish($workoutSession);

        return response()->json(['workout_session' => WorkoutSessionResource::make($workoutSession)]);
    }

    public function destroy(WorkoutSession $workoutSession): JsonResponse
    {
        Gate::authorize('delete', $workoutSession);

        $this->workoutSessionService->delete($workoutSession);

        return response()->json(['message' => 'Workout session deleted']);
    }
}
