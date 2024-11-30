<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWorkoutProgressesTable extends Migration
{
    public function up()
    {
        Schema::create('user_workout_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('workout_steps_id')->constrained('workout_steps')->onDelete('cascade');
            // $table->foreign("user_id")->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();           
            $table->date('date');
            $table->enum('status', ['pending', 'completed']);
            $table->double('calories_burned');
            $table->integer('completion_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_workout_progresses');
    }
}
