<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('image_url'); // URL gambar
            $table->string('url'); // URL produk
            $table->decimal('discount_percentage', 5, 2); // Persentase diskon
            $table->date('start_date'); // Tanggal mulai diskon
            $table->date('end_date'); // Tanggal berakhir diskon
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_products', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('discount_products');
    }
}
