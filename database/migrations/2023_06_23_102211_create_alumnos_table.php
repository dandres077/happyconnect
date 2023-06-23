<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('empresa_id')->index()->nullable();
            $table->unsignedBigInteger('temporada_id')->index()->nullable();
            $table->string('nombre1')->nullable();
            $table->string('apellido1')->nullable();
            $table->string('nombre2')->nullable();
            $table->string('apellido2')->nullable();
            $table->unsignedBigInteger('tipo_id')->index()->nullable();
            $table->string('n_documento')->nullable();
            $table->string('exp_fecha')->nullable();
            $table->unsignedBigInteger('pais_exp')->index()->nullable();
            $table->unsignedBigInteger('departamento_exp')->index()->nullable();  
            $table->string('ciudad_exp')->nullable(); 
            $table->unsignedBigInteger('pais_origen')->index()->nullable();
            $table->unsignedBigInteger('departamento_origen')->index()->nullable();
            $table->string('ciudad_origen')->nullable();                        
            $table->unsignedBigInteger('sangre_id')->index()->nullable();
            $table->unsignedBigInteger('genero_id')->index()->nullable(); 
            $table->integer('edad')->nullable(); 
            $table->date('fecha_nacimiento')->nullable(); 
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');

            
            $table->foreign('pais_exp')->references('id')->on('paises')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departamento_exp')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pais_origen')->references('id')->on('paises')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departamento_origen')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('sangre_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('genero_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('alumnos');
    }
}
