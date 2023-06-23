<?php

use Illuminate\Database\Seeder;
use App\Temporadas;

class TemporadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Temporadas::create(['empresa_id' => '1', 'nombre' => '2023', 'fecha_inicio' =>'2023-01-15', 'fecha_fin' => '2023-12-01']); 
    }
}


