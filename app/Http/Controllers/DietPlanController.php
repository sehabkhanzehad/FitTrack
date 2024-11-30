<?php

namespace App\Http\Controllers;

use App\Models\DietPlan;
use Illuminate\Http\Request;

class DietPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dietplan = DietPlan::with('food','meal')->get();

        return response()->json(['msg'=>'Success','data'=>$dietplan],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $food_id = $request->input('food_id');
        $meal_id = $request->input('meal_id');
        $calories = $request->input('calories');
        $priority = $request->input('priority');
        $carb_qty = $request->input('carb_qty');
        // $created_by = $request->header('id');
        $created_by = "1234";

        DietPlan::create([
            'food_id'=>$food_id,
            'meal_id'=>$meal_id,
            'calories'=>$calories,
            'priority'=>$priority,
            'carb_qty'=>$carb_qty,
            'created_by'=>$created_by,
        ]);

        return response()->json(['msg'=>'Success'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
