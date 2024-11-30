<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'food_name','created_by','updated_by'
    ];

    public function diet_plan(){
        return $this->hasMany(DietPlan::class);
    }
}
