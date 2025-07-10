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
        Schema::create('componentes__estacions', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->foreignId('id_categoria')->constrained('categorias','id')->onDelete('cascade'); 
            $table->foreignId('id_estado')->constrained('estados','id_estado')->onDelete('cascade');             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componentes__estacions');
    }
};
