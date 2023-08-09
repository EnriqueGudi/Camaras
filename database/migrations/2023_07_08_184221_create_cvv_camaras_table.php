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
        Schema::create('cvv_camaras', function (Blueprint $table) {
            $table->id();
            $table->string('no_serie', 45);
            $table->string('estatus', 45);
            $table->string('motivo_baja', 200)->nullable();
            $table->dateTime('fecha_baja')->nullable();
            $table->string('foto_cam', 120)->nullable();
            $table->dateTime('fecha_disp')->nullable();
            $table->string('dir_mac', 45);
            $table->string('nombre_cam', 45);
            $table->unsignedBigInteger('id_modelo');
            $table->foreign('id_modelo')->references('id')->on('cvv_modelos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvv_camaras');
    }
};
