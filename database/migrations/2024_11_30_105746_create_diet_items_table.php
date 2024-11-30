<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietItemsTable extends Migration
{
    public function up()
    {
        Schema::create('diet_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diet_plans_id')->constrained('diet_plans')->onDelete('cascade');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snack']);
            $table->string('food_name');
            $table->double('calories');
            $table->double('carbs');
            $table->string('priorities')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diet_items');
    }
}
