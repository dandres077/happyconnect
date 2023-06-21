<?php

use Illuminate\Database\Seeder;
use App\Asignaturas;

class AsignaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '1', 'nombre'=> 'Ciencias Naturales']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '2', 'nombre'=> 'Ciencias Sociales']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '3', 'nombre'=> 'Democracia']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '4', 'nombre'=> 'Educación Artística']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '5', 'nombre'=> 'Música']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '6', 'nombre'=> 'Estética']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '7', 'nombre'=> 'Ética']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '8', 'nombre'=> 'Cátedra de la paz']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '1', 'nombre'=> 'Educación Física']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '2', 'nombre'=> 'Religión']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '3', 'nombre'=> 'Lengua Castellana']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '4', 'nombre'=> 'Lectura']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '5', 'nombre'=> 'Plan lector']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '6', 'nombre'=> 'Inglés.']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '7', 'nombre'=> 'Pensamiento Numérico']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '8', 'nombre'=> 'Pensamiento Métrico']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '1', 'nombre'=> 'Pensamiento Aleatorio y Variacional']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '2', 'nombre'=> 'informática']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '3', 'nombre'=> 'Convivencia']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '4', 'nombre'=> 'Desarrollo personal']);
        Asignaturas::create(['empresa_id' => '1', 'area_id' => '5', 'nombre'=> 'Compromisos institucionales']);
    }
}




