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
        Schema::create('unidad_de_medidas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50); // Nombre de la unidad (por ejemplo, "libras")
            $table->string('abreviatura',10);
            $table->decimal('conversion', 10, 2); // Factor de conversión entre unidades    
            $table->enum('estado',['Activa','Inactiva'])->default('Activa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad_de_medidas');
    }
};
