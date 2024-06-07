<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('transaksi_details');
        Schema::dropIfExists('transaksis');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('harga', 15, 2);
            $table->string('delivery_method');
            $table->string('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->integer('status')->default(0);
            $table->decimal('service_fee', 15, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};
