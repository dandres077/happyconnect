<?php

use Illuminate\Database\Seeder;
use App\Tareas;

class TareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tareas::create([
            'empresa_id' => '1',
            'temporada_id' => '1',
            'periodo_id' => '1',
            'grado_id' => '7',
            'paralelo_id' => '13',
            'asignatura_id' => '19',
            'tarea' => 'Desarrollar una mapa conceptual sobre lo visto en clase',
            'imagen' => 'https://st2.depositphotos.com/3662505/6878/i/950/depositphotos_68789187-stock-photo-students.jpg',
            'fecha_entrega' => '2023-07-17',
            'user_create' => '2'
        ]);

        Tareas::create([
            'empresa_id' => '1',
            'temporada_id' => '1',
            'periodo_id' => '1',
            'grado_id' => '7',
            'paralelo_id' => '13',
            'asignatura_id' => '4',
            'tarea' => 'Exposión para la próxima clase sobre la relación de la independencia con la asignatura',
            'imagen' => 'https://st2.depositphotos.com/3662505/6878/i/950/depositphotos_68789187-stock-photo-students.jpg',
            'fecha_entrega' => '2023-07-21',
            'user_create' => '2'
        ]);

        Tareas::create([
            'empresa_id' => '1',
            'temporada_id' => '1',
            'periodo_id' => '1',
            'grado_id' => '7',
            'paralelo_id' => '13',
            'asignatura_id' => '16',
            'tarea' => 'Realizar las páginas 12 y 15 de libro',
            'imagen' => 'https://st2.depositphotos.com/3662505/6878/i/950/depositphotos_68789187-stock-photo-students.jpg',
            'fecha_entrega' => '2023-07-24',
            'user_create' => '2'
        ]);

        Tareas::create([
            'empresa_id' => '1',
            'temporada_id' => '1',
            'periodo_id' => '1',
            'grado_id' => '7',
            'paralelo_id' => '13',
            'asignatura_id' => '6',
            'tarea' => 'Trear elementos para hacer una actividad de lo visto en clase',
            'imagen' => 'https://st2.depositphotos.com/3662505/6878/i/950/depositphotos_68789187-stock-photo-students.jpg',
            'fecha_entrega' => '2023-07-25',
            'user_create' => '2'
        ]);
    }
}



