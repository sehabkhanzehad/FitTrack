<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkoutProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'workout_steps_id', 'date', 'status', 'calories_burned', 'completion_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workoutStep()
    {
        return $this->belongsTo(WorkoutStep::class);
    }
}
