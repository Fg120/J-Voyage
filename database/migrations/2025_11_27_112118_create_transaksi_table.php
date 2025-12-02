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
            $table->unsignedBigInteger('pengelola_id');
            $table->foreign('pengelola_id')->references('id')->on('pengelola')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('kode')->nullable();
            // Data pemesan
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            // Data kunjungan
            $table->date('tanggal_kunjungan');
            $table->integer('jumlah');
            $table->string('catatan')->nullable();
            $table->unsignedBigInteger('harga_satuan');
            $table->unsignedBigInteger('total_harga');
            $table->string('metode_pembayaran');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status')->default('pending')->comment('pending, verified, rejected');
            $table->timestamp('scanned_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
