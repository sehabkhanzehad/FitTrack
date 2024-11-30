<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDietProgressesTable extends Migration
{
    public function up()
    {
        Schema::create('user_diet_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('diet_items_id')->constrained('diet_items')->onDelete('cascade');
            $table->date('date');
            $table->double('calories_taken');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_diet_progresses');
    }
}
