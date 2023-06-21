<?php

use Illuminate\Database\Seeder;
use App\Marcas;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marcas::create([
        	'nombre' => 'Mazda', 
        	'user_create' => 2
        ]);

        Marcas::create([
        	'nombre' => 'Renault', 
        	'user_create' => 2
        ]);

        Marcas::create([
        	'nombre' => 'Mercedez', 
        	'user_create' => 2
        ]);

        Marcas::create([
        	'nombre' => 'Kia', 
        	'user_create' => 3
        ]);

        Marcas::create([
        	'nombre' => 'Toyota', 
        	'user_create' => 3
        ]);

        Marcas::create([
        	'nombre' => 'Ferrari', 
        	'user_create' => 3
        ]);
    }
}
