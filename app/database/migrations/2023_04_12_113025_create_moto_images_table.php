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
        Schema::create('moto_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moto_id');
            $table->string('url_image');
            $table->timestamps();

            $table->foreign('moto_id')->references('id')->on('motos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moto_images');
    }
};
