<?php
// ! Copyright @ Syahri Ramadhan Wiraasmara (ARI)

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
        //
        Schema::create('aw2001_umkmku', function (Blueprint $table) {
            $table->string('id_umkm')->primary();
            $table->integer('id')->foreignId();
            $table->string('nama_umkm');
            $table->date('tgl_berdiri')->nullable();
            $table->string('jenis_usaha');
            $table->string('deskripsi')->nullable();
            $table->string('no_tlp', 20)->nullable();
            $table->string('logo_umkm')->nullable();
            $table->string('foto_umkm')->nullable();
            $table->string('alamat')->nullable();
            $table->bigInteger('longitude')->nullable();
            $table->bigInteger('latitude')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('aw2001_umkmku');
    }
};
