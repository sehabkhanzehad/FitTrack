<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id','meal_id','priority','calories','carb_qty','created_by','updated_by'
    ];

    public function food(){
        return $this->belongsTo(Food::class);
    }

    public function meal(){
        return $this->belongsTo(Meal::class);
    }
}
