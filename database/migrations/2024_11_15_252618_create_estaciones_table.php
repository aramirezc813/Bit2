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
        Schema::create('estaciones', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->foreignId('id_area')->constrained('areas', 'id')->onDelete('cascade'); 
            $table->foreignId('id_ip')->constrained('i_p_s', 'id')->onDelete('cascade'); 
            $table->foreignId('id_silla')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
            $table->foreignId('id_archivero')->constrained('inventarios','id_inventario')->onDelete('cascade'); 
            $table->boolean('asignado')->default(0);
           
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estaciones');
    }
};
