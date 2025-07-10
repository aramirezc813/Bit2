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
        Schema::create('propuesta_asignacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuarios')->constrained('usuarios', 'id_usuario')->onDelete('cascade');  
            $table->foreignId('id_estacion')->constrained('estaciones','id')->onDelete('cascade');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propuesta_asignacions');
    }
};
