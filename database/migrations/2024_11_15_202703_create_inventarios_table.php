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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->foreignId('id_compE')->constrained('componentes__estacions','id')->onDelete('cascade'); 
            $table->foreignId('id_categoria')->constrained('categorias','id')->onDelete('cascade'); 
            $table->foreignId('id_estado')->constrained('estados','id_estado')->onDelete('cascade')->default(1);
            $table->dateTime('fecha_hora');
            $table->string('numeroinventario');
            $table->string('numeroserie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
