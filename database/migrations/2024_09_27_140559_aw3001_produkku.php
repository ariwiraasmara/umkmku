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
        Schema::create('aw3001_produkku', function (Blueprint $table) {
            $table->string('id_produk')->primary();
            $table->string('id_umkm')->foreignId();
            $table->string('nama');
            $table->string('merk')->nullable()->default(null);
            $table->string('jenis')->nullable()->default(null);
            $table->string('deskripsi')->nullable()->default(null);
            $table->integer('harga');
            $table->integer('stok')->nullable()->default(0);
            $table->string('satuan_unit')->nullable()->default(null);
            $table->double('diskon')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('aw3001_produkku');
    }
};
