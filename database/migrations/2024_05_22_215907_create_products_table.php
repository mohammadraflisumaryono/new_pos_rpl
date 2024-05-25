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
            $table->category_id('category_id');
            $table->string('nama');
            $table->string('barcode')->unique();
            $table->string('image')->nullable();
            $table->decimal('harga', 15, 2);
            $table->decimal('netto', 15, 2);
            $table->string('dimensi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
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
