<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutStepsTable extends Migration
{
    public function up()
    {
        Schema::create('workout_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_id')->constrained('workouts')->onDelete('cascade');
            $table->string('exercise_name');
            $table->integer('quantity');
            $table->double('calories_burned');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workout_steps');
    }
}
