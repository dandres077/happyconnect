<?php

use Illuminate\Database\Seeder;
use App\Paises;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paises::create(['nombre' => 'Argentina']);
		Paises::create(['nombre' => 'Bolivia']);
		Paises::create(['nombre' => 'Brasil']);
		Paises::create(['nombre' => 'Chile']);
		Paises::create(['nombre' => 'Colombia']);
		Paises::create(['nombre' => 'Costa Rica']);
		Paises::create(['nombre' => 'Cuba']);
		Paises::create(['nombre' => 'Ecuador']);
		Paises::create(['nombre' => 'El Salvador']);
		Paises::create(['nombre' => 'Guayana Francesa']);
		Paises::create(['nombre' => 'Granada']);
		Paises::create(['nombre' => 'Guatemala']);
		Paises::create(['nombre' => 'Guayana']);
		Paises::create(['nombre' => 'Haití']);
		Paises::create(['nombre' => 'Honduras']);
		Paises::create(['nombre' => 'Jamaica']);
		Paises::create(['nombre' => 'México']);
		Paises::create(['nombre' => 'Nicaragua']);
		Paises::create(['nombre' => 'Paraguay']);
		Paises::create(['nombre' => 'Panamá']);
		Paises::create(['nombre' => 'Perú']);
		Paises::create(['nombre' => 'Puerto Rico']);
		Paises::create(['nombre' => 'República Dominicana']);
		Paises::create(['nombre' => 'Surinam']);
		Paises::create(['nombre' => 'Uruguay']);
		Paises::create(['nombre' => 'Venezuela']);
    }
}