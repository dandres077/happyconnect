<?php

use Illuminate\Database\Seeder;
use App\Padres;

class PadresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $padres = factory(Padres::class, 300)->create(['tipo_familiar' => 47]);
        //$madres = factory(Padres::class, 300)->create(['tipo_familiar' => 48]);
    }
}
