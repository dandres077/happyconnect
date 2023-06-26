<?php

use Illuminate\Database\Seeder;
use App\Alumnos;

class AlumnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alumnos = factory(Alumnos::class, 300)->create();
    }
}
