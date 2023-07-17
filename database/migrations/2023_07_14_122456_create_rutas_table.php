<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('empresa_id')->index()->nullable(); 
            $table->unsignedBigInteger('temporada_id')->index()->nullable();             
            $table->unsignedBigInteger('proveedor_id')->index()->nullable();             
            $table->string('nombre')->nullable();          
            $table->string('marca')->nullable();          
            $table->string('modelo')->nullable();          
            $table->string('placa')->nullable();          
            $table->text('imagen')->nullable();          
            $table->string('conductor')->nullable();          
            $table->string('tel_conductor')->nullable();          
            $table->string('monitor')->nullable();                    
            $table->string('tel_monitor')->nullable();                    
            $table->text('observaciones')->nullable();                    
            $table->integer('status')->default(1); // 1: activo, 2:inactivo: 3: eliminado
            $table->integer('user_create')->nullable(); 
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutas');
    }
}
