<?php

use Illuminate\Database\Seeder;
use App\Niveles;

class NivelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Niveles::create(['empresa_id' => '1', 'nombre' => 'Inicial']);
        Niveles::create(['empresa_id' => '1', 'nombre' => 'Preescolar']);
        Niveles::create(['empresa_id' => '1', 'nombre' => 'Básica']);
        Niveles::create(['empresa_id' => '1', 'nombre' => 'Media']);
        Niveles::create(['empresa_id' => '1', 'nombre' => 'Secundaria']);
    }
}
