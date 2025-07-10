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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('id_equipo');
           /* $table->foreignId('id_pantalla')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
             $table->foreignId('id_cpu')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
            $table->foreignId('id_teclado')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
            $table->foreignId('id_mouse')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
            $table->foreignId('id_auricular')->constrained('inventarios','id_inventario')->onDelete('cascade');
            $table->foreignId('id_supresor')->constrained('inventarios','id_inventario')->onDelete('cascade');
            $table->foreignId('id_telefono')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
            $table->foreignId('id_laptop')->constrained('inventarios','id_inventario')->onDelete('cascade');  */
            
            $table->dateTime('fecha_alta');
            $table->dateTime('fecha_baja');           
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
