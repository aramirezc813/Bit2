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
        Schema::create('jlaborals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dias')->constrained('dias','id_dias')->onDelete('cascade'); 
            $table->string('entrada');
            $table->string('salida');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jlaborals');
    }
};
