<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
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
            $table->date('tgl_berdiri')->nullable()->default(null);
            $table->string('jenis_usaha');
            $table->string('deskripsi')->nullable()->default(null);
            $table->string('no_tlp', 20)->nullable()->default(null);
            $table->string('logo_umkm')->nullable()->default(null);
            $table->string('foto_umkm')->nullable()->default(null);
            $table->string('alamat')->nullable()->default(null);
            $table->bigInteger('longitude')->nullable()->default(null);
            $table->bigInteger('latitude')->nullable()->default(null); 
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
