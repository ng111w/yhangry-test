<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $tableName = 'menus';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId("cuisine_id")->constrained();
            $table->text('description')->nullable();
            $table->boolean('display_text')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_vegan')->nullable();
            $table->boolean('is_vegetarian')->nullable();
            $table->string('name')->nullable();
            $table->boolean('status')->nullable();
            $table->text("groups")->nullable();
            $table->integer('price_per_person')->nullable();
            $table->integer('min_spend')->nullable();
            $table->boolean('is_seated')->nullable();
            $table->boolean('is_standing')->nullable();
            $table->boolean('is_canape')->nullable();
            $table->boolean('is_mixed_dietary')->nullable();
            $table->boolean('is_meal_prep')->nullable();
            $table->boolean('is_halal')->nullable();
            $table->boolean('is_kosher')->nullable();
            $table->string('price_includes')->nullable();
            $table->string('highlight')->nullable();
            $table->boolean('available')->nullable();
            $table->integer('number_of_orders')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
