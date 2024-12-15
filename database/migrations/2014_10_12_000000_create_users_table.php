<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['GUEST', 'STAFF', 'HEAD_STAFF'])->default('GUEST'); // Menambahkan default value
            $table->timestamp('email_verified_at')->nullable(); // Menambahkan kolom untuk verifikasi email jika diperlukan
            $table->rememberToken(); // Untuk fitur "remember me" pada autentikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
