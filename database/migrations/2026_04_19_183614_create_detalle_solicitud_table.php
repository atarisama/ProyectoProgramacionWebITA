<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('detalle_solicitud', function (Blueprint $table) {
            $table->id();

            $table->foreignId('solicitud_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('medicamento_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('material_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

            $table->integer('cantidad');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('detalle_solicitud');
    }
};