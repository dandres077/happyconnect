<?php

use Illuminate\Database\Seeder;
use App\Periodos;

class PeriodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periodos::create(['empresa_id' => '1', 'temporada_id' => '1', 'nombre' => 'Periodo 1', 'fecha_inicio' =>'2023-01-01', 'fecha_fin' => '2023-03-01']); 
        Periodos::create(['empresa_id' => '1', 'temporada_id' => '1', 'nombre' => 'Periodo 2', 'fecha_inicio' =>'2023-01-01', 'fecha_fin' => '2023-03-01']); 
        Periodos::create(['empresa_id' => '1', 'temporada_id' => '1', 'nombre' => 'Periodo 3', 'fecha_inicio' =>'2023-01-01', 'fecha_fin' => '2023-03-01']); 
        Periodos::create(['empresa_id' => '1', 'temporada_id' => '1', 'nombre' => 'Periodo 4', 'fecha_inicio' =>'2023-01-01', 'fecha_fin' => '2023-03-01']); 
    }
}
