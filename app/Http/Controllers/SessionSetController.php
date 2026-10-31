<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionSetRequest;
use App\Http\Requests\UpdateSessionSetRequest;
use App\Http\Resources\SessionSetResource;
use App\Models\SessionSet;
use App\Models\WorkoutSession;
use App\Services\WorkoutSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class SessionSetController extends Controller
{
    public function __construct(private readonly WorkoutSessionService $workoutSessionService)
    {
    }

    public function store(StoreSessionSetRequest $request, WorkoutSession $workoutSession): JsonResponse
    {
        Gate::authorize('update', $workoutSession);

        $sessionSet = $this->workoutSessionService->addSet($workoutSession, $request->validated());

        return response()->json(['set' => SessionSetResource::make($sessionSet)], 201);
    }

    public function update(UpdateSessionSetRequest $request, SessionSet $sessionSet): JsonResponse
    {
        Gate::authorize('update', $sessionSet);

        $sessionSet = $this->workoutSessionService->updateSet($sessionSet, $request->validated());

        return response()->json(['set' => SessionSetResource::make($sessionSet)]);
    }

    public function destroy(SessionSet $sessionSet): JsonResponse
    {
        Gate::authorize('delete', $sessionSet);

        $this->workoutSessionService->deleteSet($sessionSet);

        return response()->json(['message' => 'Set deleted']);
    }
}
