<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDietProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'diet_items_id', 'date', 'calories_taken'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dietItem()
    {
        return $this->belongsTo(DietItem::class);
    }
}
