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
        Schema::create('aw4002_detailtransaksi', function (Blueprint $table) {
            $table->string('id_detailtransaksi')->primary();
            $table->string('id_transaksi')->foreignId();
            $table->string('id_produk')->foreignId();
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('aw4002_detailtransaksi');
    }
};
