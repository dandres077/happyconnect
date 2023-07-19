<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();       
            $table->unsignedBigInteger('usuario_id')->index()->nullable();     
            $table->unsignedBigInteger('empresa_id')->index()->nullable();     
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();            
            $table->unsignedBigInteger('genero_id')->index()->nullable();
            $table->unsignedBigInteger('tipo_documento')->index()->nullable();
            $table->string('n_documento')->nullable();
            $table->string('fecha_nacimiento')->nullable();   
            $table->unsignedBigInteger('civil_id')->index()->nullable();         
            $table->longtext('estudios')->nullable();
            $table->longtext('perfil')->nullable();
            $table->longtext('experiencia')->nullable();
            $table->text('imagen')->nullable();
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_documento')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('genero_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('civil_id')->references('id')->on('catalogos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesionales');
    }
}
