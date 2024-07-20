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
        Schema::create('detail_data_sub_menus', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->text('value');
            $table->unsignedBigInteger('dataSubmenu_id'); 
            $table->timestamps();

            $table->foreign('dataSubmenu_id')->references('id')->on('data_sub_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_data_sub_menus');
    }
};
