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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to associate the goal with a user
            $table->string('goal_type'); // Type of goal (e.g., "Workout", "Calories", "Steps", etc.)
            $table->integer('target')->nullable(); // Target value (e.g., steps count, calories to burn)
            $table->string('unit')->nullable(); // Unit for the target (e.g., "calories", "steps", "kg")
            $table->date('start_date')->nullable(); // Start date for the goal
            $table->date('end_date'); // End date or deadline for the goal
            $table->integer('progress')->default(0); // Progress percentage (e.g., 40% of the goal)
            $table->text('description')->nullable(); // Optional description or notes about the goal
            $table->boolean('achieved')->default(false); // Whether the goal has been achieved
            $table->date('achieved_date')->nullable(); // Date the goal was achieved
            $table->timestamp('created_at')->useCurrent()->nullable(); // Created at timestamp
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable(); // Updated at timestamp
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
