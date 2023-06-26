<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Padres;
use Faker\Generator as Faker;

$factory->define(Padres::class, function (Faker $faker) {
    return [
        'empresa_id' => 1,
        'temporada_id' => 1,
        'tipo_familiar' => 48,
        'alumno_id' => $faker->unique()->numberBetween(1, 300),
        'nombres' => $faker->firstName,
        'apellidos' => $faker->lastName,
        'tipo_doc_id' => 2,
        'n_documento' => 1015401478,
        'exp_municipio' => $faker->city,
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'celular' => $faker->phoneNumber,
        'email' => $faker->email,
        'profesion' => $faker->jobTitle,
        'nivel_educativo' => $faker->randomElement(['Primaria', 'Secundaria', 'Universidad']),
        'empr_nombre' => $faker->company,
        'empr_ocupacion' => $faker->jobTitle,
        'empr_direccion' => $faker->address,
        'empr_telefono' => $faker->phoneNumber,
        'empr_email' => $faker->email
    ];
});

