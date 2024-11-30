<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_id', 'exercise_name', 'quantity', 'calories_burned'
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function userWorkoutProgresses()
    {
        return $this->hasMany(UserWorkoutProgress::class);
    }
}
