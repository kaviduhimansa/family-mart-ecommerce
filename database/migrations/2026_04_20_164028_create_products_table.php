<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the products table.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key
            // Foreign key linking to the categories table [cite: 51, 86]
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
            $table->string('name'); // Product name [cite: 76]
            $table->text('description')->nullable(); // Detailed product description [cite: 76]
            $table->decimal('price', 10, 2); // Product price with 2 decimal places [cite: 76, 52]
            $table->string('image')->nullable(); // Path to the product image [cite: 49, 76]
            $table->integer('stock')->default(0); // Available quantity in stock
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};