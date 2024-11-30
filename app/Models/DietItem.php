<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'diet_plans_id', 'meal_type', 'food_name', 'calories', 'carbs', 'priorities'
    ];

    public function dietPlan()
    {
        return $this->belongsTo(DietPlan::class);
    }
}
