<?php

use Illuminate\Database\Seeder;
use App\Rutas;

class RutasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rutas::create([
            'empresa_id' => '1',
            'temporada_id' => '1',
            'proveedor_id' => '1',
            'nombre' => 'Ruta N° 1',
            'marca' => 'Nissan Captiva',
            'modelo' => '2021',
            'placa' => 'WES654',
            'imagen' => 'http://localhost/happyconnect/public/imagenes/Ruta1.jpg',
            'conductor' => 'Juan Rosales / Miguel Tovares',
            'tel_conductor' => '321 8796598',
            'monitor' => 'Camila Torres',
            'tel_monitor' => '325 9632587',
            'observaciones' => 'Dispone de 2 conductores y 2 monitores por ruta.'
        ]);

        Rutas::create([
            'empresa_id' => '1',
            'temporada_id' => '1',
            'proveedor_id' => '2',
            'nombre' => 'Ruta N° 2',
            'marca' => 'Volskwagen',
            'modelo' => '2020',
            'placa' => 'QWE852',
            'imagen' => 'http://localhost/happyconnect/public/imagenes/Ruta2.jpg',
            'conductor' => 'David Gutierrez',
            'tel_conductor' => '321 7896541',
            'monitor' => 'Diana Carolina Torres',
            'tel_monitor' => '325 852988754',
            'observaciones' => 'Con documentación al día.'
        ]);
    }
}




        