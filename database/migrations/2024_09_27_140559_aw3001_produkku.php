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
        Schema::create('aw3001_produkku', function (Blueprint $table) {
            $table->string('id_produk')->primary();
            $table->string('id_umkm')->foreignId();
            $table->string('nama');
            $table->string('merk')->nullable();
            $table->string('jenis')->nullable();
            $table->string('deskripsi')->nullable();
            $table->integer('harga');
            $table->integer('stok')->nullable();
            $table->string('satuan_unit')->nullable();
            $table->double('diskon')->nullable();
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
