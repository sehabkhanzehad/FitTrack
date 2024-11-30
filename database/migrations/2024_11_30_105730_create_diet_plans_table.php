<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietPlansTable extends Migration
{
    public function up()
    {
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('trainer_id')->constrained('trainers')->onDelete('cascade');
            $table->string('name');
            $table->double('calories');
            $table->double('carbs');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diet_plans');
    }
}
