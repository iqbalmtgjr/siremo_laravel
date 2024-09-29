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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade');
            $table->foreignId('mitra_id')->references('id')->on('mitra')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('ktp')->nullable();
            $table->integer('lama_sewa');
            $table->string('total_harga');
            $table->string('pembayaran'); //lunas, belum_lunas
            $table->string('status'); //proses, selesai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
