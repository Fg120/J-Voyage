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
        Schema::create('pengelola', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->string('nama_wisata');
            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('restrict');
            $table->unsignedBigInteger('desa_id')->nullable();
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('restrict');
            $table->string('alamat_wisata');
            $table->text('deskripsi_wisata');
            $table->string('foto_wisata')->nullable();
            $table->string('kontak_wisata')->nullable();
            $table->string('jam_buka')->nullable();
            $table->string('jam_tutup')->nullable();

            // Keperluan pengajuan
            $table->string('file_izin')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_npwp')->nullable();
            $table->text('alasan_pengajuan')->nullable();
            $table->text('catatan_admin')->nullable();

            $table->string('status')->default('pending')->comment('pending, approved, rejected, blocked');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengelola');
    }
};
