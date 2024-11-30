<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserWorkoutProgress;

class UserWorkoutProgressController extends Controller
{
    public function index()
    {
        $userWorkoutProgresses = UserWorkoutProgress::all();
        return response()->json($userWorkoutProgresses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'workout_steps_id' => 'required|exists:workout_steps,id',
            'date' => 'required|date',
            'status' => 'required|in:pending,completed',
            'calories_burned' => 'required|numeric',
            'completion_time' => 'required|integer',
        ]);

        $progress = UserWorkoutProgress::create($validated);
        return response()->json($progress);
    }

    public function show($id)
    {
        $progress = UserWorkoutProgress::find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress not found'], 404);
        }
        return response()->json($progress);
    }

    public function update(Request $request, $id)
    {
        $progress = UserWorkoutProgress::find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'workout_steps_id' => 'exists:workout_steps,id',
            'date' => 'date',
            'status' => 'in:pending,completed',
            'calories_burned' => 'numeric',
            'completion_time' => 'integer',
        ]);

        $progress->update($validated);
        return response()->json($progress);
    }

    public function destroy($id)
    {
        $progress = UserWorkoutProgress::find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress not found'], 404);
        }

        $progress->delete();
        return response()->json(['message' => 'Progress deleted successfully']);
    }
}

