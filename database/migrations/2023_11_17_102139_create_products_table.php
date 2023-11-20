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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 255);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->string('product_code', 20)->nullable();
            $table->enum('is_active', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->text('description')->nullable();
            $table->decimal('price',15,2)->default(0);
            $table->string('unit', 100);
            $table->decimal('discount_amount',15,2)->nullable();
            $table->integer('stock')->default(0);
            $table->text('image')->nullable();
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
