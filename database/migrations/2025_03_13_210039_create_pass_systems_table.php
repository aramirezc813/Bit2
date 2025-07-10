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
        Schema::create('pass_systems', function (Blueprint $table) {
            $table->id('id_password');
            $table->string('sistema');
            $table->timestamps();
            $table->foreignId('id_usuario')->constrained('usuarios','id_usuario')->onDelete('cascade')->default(1);



           





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_systems');
    }
};
