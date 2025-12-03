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
        Schema::table('pengelola', function (Blueprint $table) {
            if (! Schema::hasColumn('pengelola', 'nomor_rekening')) {
                $table->string('nomor_rekening')->nullable();
            }
            if (! Schema::hasColumn('pengelola', 'nama_bank')) {
                $table->string('nama_bank')->nullable();
            }
            if (! Schema::hasColumn('pengelola', 'nama_pemilik_rekening')) {
                $table->string('nama_pemilik_rekening')->nullable();
            }
            if (! Schema::hasColumn('pengelola', 'harga')) {
                $table->unsignedBigInteger('harga')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengelola', function (Blueprint $table) {
            //
        });
    }
};
