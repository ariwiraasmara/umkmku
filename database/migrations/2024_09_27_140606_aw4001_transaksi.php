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
        Schema::create('aw4001_transaksi', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->string('id_umkm')->foreignId();
            $table->string('no_nota')->unique()->nullable()->default('client x');
            $table->datetime('tgl');
            $table->string('id_user');
            $table->string('diskon')->nullable()->default(0);
            $table->text('nama_pelanggan')->nullable()->default('client x');
            $table->bigInteger('uang_diterima')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('aw4001_transaksi');
    }
};
