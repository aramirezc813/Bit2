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
        Schema::create('componentes_equipos', function (Blueprint $table) {
            $table->id('id_ce');
            $table->foreignId('id_equipo')->constrained('equipos','id_equipo')->onDelete('cascade');
            $table->foreignId('id_componente')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componentes_equipos');
    }
};
