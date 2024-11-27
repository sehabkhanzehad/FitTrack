<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{


    public function getAll()
    {
        $goals = Goal::with('user')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Workouts retrieved successfully',
            'data' => $goals
        ], 200);
    }

    public function getOne($id)
    {
        $goal = Goal::with('user')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Workout retrieved successfully',
            'data' => $goal
        ], 200);
    }

    public function getByUser($id)
    {
        $goals = Goal::where('user_id', $id)->with('user')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Workouts retrieved successfully',
            'data' => $goals
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            // $userId = $request->header('user_id');
            $userId = $request->input('user_id');
            $goalType = $request->input('goal_type');
            $target = $request->input('target');
            $unit = $request->input('unit');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $progress = $request->input('progress');
            $description = $request->input('description');
            $achieved = $request->input('achieved');
            $achievedDate = $request->input('achieved_date');

            $data = Goal::create([
                'user_id' => $userId,
                'goal_type' => $goalType,
                'target' => $target,
                'unit' => $unit,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'progress' => $progress,
                'description' => $description,
                'achieved' => $achieved,
                'achieved_date' => $achievedDate
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Goal created successfully',
                'data' => $data
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create goal',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $goal = Goal::find($id);
            $goal->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Goal updated successfully',
                'data' => $goal
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update goal',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $goal = Goal::find($id);
            $goal->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Goal deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete goal',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
