<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the categories table.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the category (e.g., Vegetables, Fruits) [cite: 45, 75]
            $table->string('slug')->unique(); // URL friendly version of the name
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations by dropping the categories table.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};