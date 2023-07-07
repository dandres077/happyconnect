<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasFrecuentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_frecuentes', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('empresa_id')->index()->nullable(); 
            $table->unsignedBigInteger('categoria_id')->index()->nullable();
            $table->string('nombre')->nullable();
            $table->longtext('descripcion')->nullable();
            $table->text('archivo')->nullable();
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('categoria_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas_frecuentes');
    }
}
