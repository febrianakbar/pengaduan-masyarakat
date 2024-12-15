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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key
            $table->string('description');
            $table->string('type');
            $table->string('province');
            $table->string('regency');
            $table->string('subdistrict');
            $table->string('village');
            $table->integer('votes')->default(0); // Menambahkan kolom votes
            $table->integer('viewers')->default(0);
            $table->string('image')->nullable();
            $table->boolean('statement')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};