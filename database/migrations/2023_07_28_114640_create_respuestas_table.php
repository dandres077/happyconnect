<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('empresa_id')->index()->nullable();  
            $table->unsignedBigInteger('temporada_id')->index()->nullable();  
            $table->unsignedBigInteger('mensaje_id')->index()->nullable();  
            $table->string('asunto')->nullable();
            $table->text('mensaje')->nullable();
            $table->text('adjunto')->nullable();            
            $table->unsignedBigInteger('usuario_envia')->index()->nullable(); 
            $table->unsignedBigInteger('usuario_recibe')->index()->nullable(); 
            $table->integer('status')->default(1); // 1: Sin leer, 2:Leido: 3: eliminado
            $table->integer('user_create')->nullable();
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mensaje_id')->references('id')->on('mensajes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usuario_envia')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usuario_recibe')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
