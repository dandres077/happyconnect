<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Alumnos;
use Faker\Generator as Faker;

$factory->define(Alumnos::class, function (Faker $faker) {
    return [
        'empresa_id' => 1,
        'temporada_id' => 1,
        'nombre1' => $faker->firstName,
        'apellido1' => $faker->lastName,
        'nombre2' => $faker->firstName,
        'apellido2' => $faker->lastName,
        'tipo_id' => 3,
        'n_documento' => $faker->numberBetween(1, 1015401403),
        'exp_fecha' => $faker->dateTimeBetween($startDate = '-23 years', $endDate = 'now')->format('Y-m-d'),
        'pais_exp' => 5,
        'departamento_exp' => $faker->numberBetween(1, 28),
        'ciudad_exp' => $faker->city,
        'pais_origen' => 5,
        'departamento_origen' => $faker->numberBetween(1, 28),
        'ciudad_origen' => $faker->city,
        'sangre_id' => $faker->numberBetween(49, 56),
        'genero_id' => $faker->numberBetween(17, 19),
        'edad' => $faker->numberBetween(4, 17),
        'fecha_nacimiento' => $faker->dateTimeBetween($startDate = '-23 years', $endDate = 'now')->format('Y-m-d'),
    ];
});
