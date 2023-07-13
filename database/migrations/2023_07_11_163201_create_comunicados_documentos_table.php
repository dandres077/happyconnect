<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunicadosDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicados_documentos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('empresa_id')->index()->nullable(); 
            $table->unsignedBigInteger('comunicado_id')->index()->nullable();
            $table->unsignedBigInteger('grado_id')->index()->nullable();
            $table->unsignedBigInteger('paralelo_id')->index()->nullable();            
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('comunicado_id')->references('id')->on('comunicados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunicados_documentos');
    }
}
