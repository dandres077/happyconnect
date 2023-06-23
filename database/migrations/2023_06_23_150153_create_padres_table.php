<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePadresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padres', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('empresa_id')->index()->nullable();
            $table->unsignedBigInteger('temporada_id')->index()->nullable();
            $table->unsignedBigInteger('tipo_familiar')->index()->nullable();// 1:Padre ; 2:Madre
            $table->unsignedBigInteger('alumno_id')->index()->nullable();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->unsignedBigInteger('tipo_doc_id')->index()->nullable();
            $table->string('n_documento')->nullable();
            $table->string('exp_municipio')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('profesion')->nullable();
            $table->string('nivel_educativo')->nullable();
            $table->string('empr_nombre')->nullable();
            $table->string('empr_ocupacion')->nullable();
            $table->string('empr_direccion')->nullable();
            $table->string('empr_telefono')->nullable();
            $table->string('empr_email')->nullable();
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('tipo_doc_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_familiar')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('padres');
    }
}
