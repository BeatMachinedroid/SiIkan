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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_ikan');
            $table->foreign('id_ikan')->references('id')->on('ikans')->onDelete('cascade');

            $table->char('kode_order');
            $table->integer('jumlah');
            $table->char('total_harga');
            $table->string('alamat');
            $table->string('no_telpon');
            $table->string('metode_pembayaran');
            $table->char('ongkir');
            $table->string('batas_pembayaran')->nullable();
            $table->string('status_order');
            $table->string('status_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
