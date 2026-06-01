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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_paciente');
            $table->string('nombre_doctor');
            $table->string('enfermedad');
            $table->decimal('monto', 10, 2);
            $table->enum('estado', ['Hospitalizado', 'Dado de Alta'])->default('Hospitalizado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
