<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function getAll()
    {
        $workouts = Workout::with('user')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Workouts retrieved successfully',
            'data' => $workouts
        ], 200);
    }
    public function getOne($id)
    {
        $workout = Workout::with('user')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Workout retrieved successfully',
            'data' => $workout
        ], 200);
    }
    public function getByUser($id)
    {
        $workouts = Workout::where('user_id', $id)->with('user')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Workouts retrieved successfully',
            'data' => $workouts
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            // $userId = $request->header('user_id');
            $userId = $request->input('user_id');
            $name = $request->input('name');
            $type = $request->input('type');
            $time = $request->input('time');
            $date = $request->input('date');
            $duration = $request->input('duration');
            $calories = $request->input('calories');
            $distance = $request->input('distance');

            $data = Workout::create([
                'user_id' => $userId,
                'name' => $name,
                'type' => $type,
                'time' => $time,
                'date' => $date,
                'duration' => $duration,
                'calories' => $calories,
                'distance' => $distance
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Workout created successfully',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create workout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $workout = Workout::findOrFail($id);
            $workout->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Workout updated successfully',
                'data' => $workout
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update workout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $workout = Workout::findOrFail($id);
            $workout->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Workout deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}


