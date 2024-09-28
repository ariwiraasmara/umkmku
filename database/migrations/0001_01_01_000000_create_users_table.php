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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->default('default_user_x');
            $table->string('email')->unique()->default(null);
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('tlp', 20)->nullable()->default(null);
            $table->string('password')->default(null);
            $table->integer('roles')->default(0);
            $table->rememberToken()->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('aw1002_userprofil', function (Blueprint $table) {
            $table->integer('id')->primary()->default(null);
            $table->string('nama')->nullable()->default(null);
            $table->enum('jk', ['Pria', 'Wanita'])->nullable()->default(null);
            $table->string('alamat')->nullable()->default(null);
            $table->string('foto')->nullable()->default(null);
            $table->string('tempat_lahir')->nullable()->default(null);
            $table->date('tgl_lahir')->nullable()->default(null);
            $table->string('id_umkm')->foreignId()->nullable()->default(null);
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable()->default(null);
            $table->string('jabatan')->nullable()->default(null);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('aw1002_userprofil');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
