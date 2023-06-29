<?php

use Illuminate\Database\Seeder;
use App\Areas;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Areas::create(['empresa_id' => '1', 'nombre' => 'AREA DE CIENCIAS NATURALES Y EDUCACION AMBIENTAL']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'CIENCIAS SOCIALES, HISTORIA, GEOGRAFIA, CONSTITUCION POLITICA Y DEMOCRACIA']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'EDUCACION ARTISTICA']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'EDUCACION ETICA Y EN VALORES HUMANOS']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'AREA DE EDUCACIÓN FÍSICA, RECRECIÓN Y DEPORTES']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'AREA DE EDUCACION RELIGIOSA']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'HUMANIDADES, LENGUA CASTELLANA E IDIOMAS EXTRANJEROS']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'AREA DE MATEMATICAS']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'AREA DE TECNOLOGIA E INFORMATICA']);
        Areas::create(['empresa_id' => '1', 'nombre' => 'ESPACIOS']);
    }
}


