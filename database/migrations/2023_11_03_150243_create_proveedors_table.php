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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('nit',10)->unique();
            $table->string('direccion');
            $table->string('telefono',11);
            $table->string('correo_electronico',50)->unique();
            $table->string('sitio_web')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('contacto_principal',11)->nullable();
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
