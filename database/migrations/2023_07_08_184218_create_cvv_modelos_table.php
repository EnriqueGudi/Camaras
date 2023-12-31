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
        Schema::create('cvv_modelos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_modelo', 45);
            $table->unsignedBigInteger('id_marca');
            $table->foreign('id_marca')->references('id')->on('cvv_marcas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvv_modelos');
    }
};
