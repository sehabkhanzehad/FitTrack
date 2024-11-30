<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('meal_id');
            $table->time('priority');
            $table->string('calories')->nullable();
            $table->string('carb_qty');
            $table->string('created_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('food_id')->references('id')->on('foods')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('meal_id')->references('id')->on('meals')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plans');
    }
};
