<?php

use Illuminate\Database\Seeder;
use App\Modelo;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modelo::create([
            'marca_id' => 1,
        	'nombre' => 'CX-4', 
        	'user_create' => 2
        ]);

        Modelo::create([
            'marca_id' => 2,
        	'nombre' => 'Logan', 
        	'user_create' => 2
        ]);

        Modelo::create([
            'marca_id' => 3,
        	'nombre' => 'AMG', 
        	'user_create' => 2
        ]);

        Modelo::create([
            'marca_id' => 4,
        	'nombre' => 'Cerato', 
        	'user_create' => 3
        ]);

        Modelo::create([
            'marca_id' => 5,
        	'nombre' => 'Corola', 
        	'user_create' => 3
        ]);

        Modelo::create([
            'marca_id' => 6,
        	'nombre' => 'Roma', 
        	'user_create' => 3
        ]);

    }
}
