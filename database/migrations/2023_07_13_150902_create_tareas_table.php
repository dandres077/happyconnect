<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('empresa_id')->index()->nullable(); 
            $table->unsignedBigInteger('temporada_id')->index()->nullable();
            $table->unsignedBigInteger('periodo_id')->index()->nullable();
            $table->unsignedBigInteger('grado_id')->index()->nullable();
            $table->unsignedBigInteger('paralelo_id')->index()->nullable();            
            $table->unsignedBigInteger('asignatura_id')->index()->nullable();  
            $table->text('tarea')->nullable();          
            $table->text('imagen')->nullable();          
            $table->date('fecha_entrega')->nullable();           
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->unsignedBigInteger('user_create')->index()->nullable();  
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade')->onUpdate('cascade');            
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_create')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}