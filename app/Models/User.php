<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'height', 'weight', 'gender', 'role', 'otp'
    ];

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class);
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }

    public function userWorkoutProgresses()
    {
        return $this->hasMany(UserWorkoutProgress::class);
    }

    public function userDietProgresses()
    {
        return $this->hasMany(UserDietProgress::class);
    }

    public function userActivities()
    {
        return $this->hasMany(UserActivity::class);
    }
}
