<?php

use Illuminate\Database\Seeder;
use App\Generalidades;

class GeneralidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo documento empresa']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo documento persona']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo medio de pago']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo genero']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo calendario']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo colegio oficial']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo colegio genero']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo jornada']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo colegio técnico']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Estrato']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo ubicación Rural']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo familiar']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Grupo sanguineo']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo vivienda']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo zona ciudad']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Paralelos']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo documento interno colegio']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Tipo discapacidad']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Estado civil']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Días semanas']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Bloques horarios']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Meses']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Conceptos de cobro']);
        Generalidades::create(['empresa_id' => '1', 'nombre' => 'Bancos']);
    }
}
