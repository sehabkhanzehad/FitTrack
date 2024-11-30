<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'specialization', 'experience_years'
    ];

    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class);
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }
}
