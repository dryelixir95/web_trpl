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
        Schema::create('sub_menu_fields', function (Blueprint $table) {
            $table->id();
            $table->string('nama_field');
            $table->unsignedBigInteger('submenu_id'); 
            $table->timestamps();
            
            $table->foreign('submenu_id')->references('id')->on('sub_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_menu_fields');
    }
};
