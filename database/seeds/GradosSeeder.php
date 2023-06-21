<?php

use Illuminate\Database\Seeder;
use App\Grados;

class GradosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '1','nombre' => 'Salita', 'edad' => '0-1']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '1','nombre' => 'Caminadores', 'edad' => '1-2']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '1','nombre' => 'Párvulos', 'edad' => '2-3']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '1','nombre' => 'Pre jardin', 'edad' => '3-4']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '1','nombre' => 'Jardin', 'edad' => '4-5']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '2','nombre' => 'Transición', 'edad' => '5-6']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '3','nombre' => '1', 'edad' => '6-7']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '3','nombre' => '2', 'edad' => '7-8']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '3','nombre' => '3', 'edad' => '8-9']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '3','nombre' => '4', 'edad' => '9-10']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '3','nombre' => '5', 'edad' => '10-11']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '5','nombre' => '6', 'edad' => '11-12']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '5','nombre' => '7', 'edad' => '12-13']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '5','nombre' => '8', 'edad' => '13-14']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '5','nombre' => '9', 'edad' => '14-15']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '4','nombre' => '1', 'edad' => '15-16']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '4','nombre' => '1', 'edad' => '16-17']);
        Grados::create(['empresa_id' => '1' , 'nivel_id' => '4','nombre' => '1', 'edad' => '17-18']);
    }
}



