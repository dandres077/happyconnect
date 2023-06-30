<?php

use Illuminate\Database\Seeder;
use App\Actividades;

class ActividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actividades::create(['empresa_id' => '1', 
                            'temporada_id' => '1',
                            'nombre' => 'Vacaciones', 
                            'fecha_inicio'=> '2023-06-22 08:00:00',
                            'fecha_fin'=> '2023-06-22 17:00:00',
                            'link' => '#',
                            'observaciones' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500',
                            'user_create' => 1
        ]);

        Actividades::create(['empresa_id' => '1', 
                            'temporada_id' => '1',
                            'nombre' => 'Izada de bandera - Día de la independencia', 
                            'fecha_inicio'=> '2023-07-18 08:00:00',
                            'fecha_fin'=> '2023-07-18 17:00:00',
                            'link' => '#',
                            'observaciones' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500',
                            'user_create' => 1
        ]);

        Actividades::create(['empresa_id' => '1', 
                            'temporada_id' => '1',
                            'nombre' => 'Celebración día de la cometa', 
                            'fecha_inicio'=> '2023-08-01 08:00:00',
                            'fecha_fin'=> '2023-08-01 17:00:00',
                            'link' => '#',
                            'observaciones' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500',
                            'user_create' => 1
        ]);

        Actividades::create(['empresa_id' => '1', 
                            'temporada_id' => '1',
                            'nombre' => 'Celebración Amor y Amistad', 
                            'fecha_inicio'=> '2023-09-29 08:00:00',
                            'fecha_fin'=> '2023-09-29 17:00:00',
                            'link' => '#',
                            'observaciones' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500',
                            'user_create' => 1
        ]);

        Actividades::create(['empresa_id' => '1', 
                            'temporada_id' => '1',
                            'nombre' => 'Celebración día de los niños', 
                            'fecha_inicio'=> '2023-10-22 08:00:00',
                            'fecha_fin'=> '2023-10-22 17:00:00',
                            'link' => '#',
                            'observaciones' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500',
                            'user_create' => 1
        ]);
    }
}