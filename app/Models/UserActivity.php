<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date', 'total_workout_hours', 'total_steps', 'total_pose', 'net_calories'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
