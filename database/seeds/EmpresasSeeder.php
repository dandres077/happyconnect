<?php

use Illuminate\Database\Seeder;
use App\Empresas;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresas::create([
            'nombre' => 'Colegio San Bartolome de la Merced',
            'documento' => '31058952781',
            'email' => 'contacto@sanbartolome.com',
            'telefono' => '2310449',
            'celular' => '3189652365',
            'direccion' => 'Carrera 1 52-89',
            'pais_id' => '1',
            'departamento_id' => '1',  
            'ciudad_id' => '1', 
            'estrato_id' => '42',
            'sector_id' => '23',
            'zona_id' => '44',
            'calendario_id' => '20',
            'jornada_id' => '29',
            'genero_id' => '26',           
            'rector' => 'Benito Juarez',
        ]);
    }
}