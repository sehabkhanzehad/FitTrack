<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_name','created_by','updated_by'
    ];

    public function diet_plan(){
        return $this->hasMany(DietPlan::class);
    }
}
