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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); 
            $table->date('tanggal'); 
            $table->unsignedBigInteger('kategori');
            $table->text('deskripsi'); 
            $table->json('tag')->nullable(); 
            $table->text('komen')->nullable(); 
            $table->timestamps();

            $table->foreign('kategori')->references('id')->on('kategori_posts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
