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
        Schema::create('historico_asignacion', function (Blueprint $table) {
            $table->id('id_persona');
            /* $table->string('foto'); */
           $table->foreignId('id_usuarios')->constrained('usuarios', 'id_usuario')->onDelete('cascade');  
            /* $table->string('nombre'); */
            $table->string('id_rol');
          //  $table->foreignId('id_rol')->constrained('roles', 'id')->onDelete('cascade');   
             $table->foreignId('id_estacion')->constrained('estaciones','id')->onDelete('cascade');              
            /* $table->foreignId('id_estacion')->constrained('estaciones','id')->onDelete('cascade');       */
            $table->foreignId('id_jlaboral')->constrained('jlaborals','id' )->onDelete('cascade');              
            $table->foreignId('id_hcomida')->constrained('hcomidas','id')->onDelete('cascade');      
            $table->foreignId('id_hdescanso')->constrained('hdescansos','id')->onDelete('cascade');      
            $table->foreignId('id_estado')->constrained('estados','id_estado')->onDelete('cascade')->default(1);
            $table->string('creoRegistro');
           /*  $table->tinyInteger('estado')->default(1); */
            $table->timestamps();

            /*  $table->foreignId('id_persona')->constrained('personals', 'id_persona')->onDelete('cascade');
            
            $table->foreignId('id_area')->constrained('areas', 'id_area')->onDelete('cascade'); */

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_asignacion');
    }
};
