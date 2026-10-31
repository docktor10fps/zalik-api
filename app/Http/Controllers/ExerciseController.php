<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExerciseController extends Controller
{
    public function __construct(private readonly ExerciseService $exerciseService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'exercises' => ExerciseResource::collection($this->exerciseService->list($request->user())),
        ]);
    }

    public function store(ExerciseRequest $request): JsonResponse
    {
        $exercise = $this->exerciseService->create($request->user(), $request->validated());

        return response()->json(['exercise' => ExerciseResource::make($exercise)], 201);
    }

    public function update(ExerciseRequest $request, Exercise $exercise): JsonResponse
    {
        Gate::authorize('update', $exercise);

        $exercise = $this->exerciseService->update($exercise, $request->validated());

        return response()->json(['exercise' => ExerciseResource::make($exercise)]);
    }

    public function destroy(Exercise $exercise): JsonResponse
    {
        Gate::authorize('delete', $exercise);

        $this->exerciseService->delete($exercise);

        return response()->json(['message' => 'Exercise deleted']);
    }
}
