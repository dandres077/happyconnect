<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id')->index()->nullable();
            $table->unsignedBigInteger('sede_id')->index()->nullable();
            $table->unsignedBigInteger('temporada_id')->index()->nullable();
            $table->unsignedBigInteger('grado_id')->index()->nullable();
            $table->unsignedBigInteger('paralelo_id')->index()->nullable();
            $table->unsignedBigInteger('alumno_id')->index()->nullable();
            $table->string('direccion_r')->nullable();
            $table->string('barrio_r')->nullable();
            $table->string('comuna_r')->nullable();
            $table->string('municipio_r')->nullable();
            $table->unsignedBigInteger('departamento_id')->index()->nullable();
            $table->unsignedBigInteger('estrato_id')->index()->nullable();
            $table->unsignedBigInteger('tipo_vivienda_id')->index()->nullable();
            $table->unsignedBigInteger('zona_id')->index()->nullable();
            $table->string('telefono_est')->nullable();
            $table->string('celular_est')->nullable();
            $table->string('email_est')->nullable();
            $table->string('vive_con')->nullable();
            $table->string('n_personas_hogar')->nullable();
            $table->string('n_hermanos')->nullable();
            $table->string('n_hermanos_col')->nullable();
            $table->string('telefono_f')->nullable();
            $table->string('icbf')->nullable();
            $table->string('f_accion')->nullable();
            $table->unsignedBigInteger('nee_id')->index()->nullable();
            $table->string('nee_texto')->nullable();
            $table->string('nuevo_antiguo')->nullable();
            $table->string('col_procede')->nullable();
            $table->string('ciudad_procede')->nullable();
            $table->integer('dpto_id')->nullable();
            $table->string('repitente')->nullable();
            $table->unsignedBigInteger('jornada_id')->index()->nullable();
            $table->string('estatura')->nullable();
            $table->string('peso')->nullable();
            $table->string('hijo_heroe')->nullable();
            $table->string('desvinculado')->nullable();
            $table->string('desmovilizado')->nullable();
            $table->string('nombres_acu')->nullable();
            $table->string('apellidos_acu')->nullable();
            $table->unsignedBigInteger('tipo_doc_id')->index()->nullable();
            $table->string('n_documento_acu')->nullable();
            $table->string('expedida_acu')->nullable();
            $table->string('direccion_acu')->nullable();
            $table->string('telefono_acu')->nullable();
            $table->string('celular_acu')->nullable();
            $table->string('email_acu')->nullable();
            $table->string('empresa_acu')->nullable();
            $table->string('profesion_acu')->nullable();
            $table->string('parentesco_acu')->nullable();
            $table->string('nombre_eps')->nullable();
            $table->string('beneficiario_sisben')->nullable();
            $table->string('alergias')->nullable();
            $table->string('medicamentos')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('etnia')->nullable();
            $table->string('resguardo')->nullable();
            $table->string('conflicto')->nullable();
            $table->string('nombres_fac')->nullable();
            $table->unsignedBigInteger('tipo_doc_fac_id')->index()->nullable();
            $table->string('n_documento_fac')->nullable();
            $table->string('direccion_fac')->nullable();
            $table->string('email_fac')->nullable();
            $table->string('celular_fac')->nullable();
            $table->string('token')->nullable();
            $table->date('fin_token')->nullable();
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sede_id')->references('id')->on('empresas_sedes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->onDelete('cascade')->onUpdate('cascade');            
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estrato_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_vivienda_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('zona_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jornada_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nee_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_doc_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_doc_fac_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}
