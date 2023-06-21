<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_sedes', function (Blueprint $table) {
            $table->id('id');      
            $table->unsignedBigInteger('empresa_id')->index()->nullable();      
            $table->string('nombre')->nullable();
            $table->string('documento')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('pais_id')->index()->nullable();
            $table->unsignedBigInteger('departamento_id')->index()->nullable();
            $table->unsignedBigInteger('ciudad_id')->index()->nullable();
            $table->unsignedBigInteger('estrato_id')->index()->nullable();
            $table->unsignedBigInteger('sector_id')->index()->nullable();
            $table->unsignedBigInteger('zona_id')->index()->nullable();
            $table->unsignedBigInteger('calendario_id')->index()->nullable();
            $table->unsignedBigInteger('jornada_id')->index()->nullable();
            $table->unsignedBigInteger('genero_id')->index()->nullable();
            $table->string('rector')->nullable();
            $table->string('imagen')->nullable();             
            $table->longtext('texto')->nullable();             
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estrato_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sector_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('zona_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('calendario_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jornada_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('genero_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas_sedes');
    }
}
