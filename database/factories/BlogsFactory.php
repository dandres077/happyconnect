<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blogs;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Blogs::class, function (Faker $faker) {

    $now = Carbon::now();

    return [
        'empresa_id' => 1,
        'categoria_id' => 120,
        'titulo' => $faker->text(50),
        'slug' => $faker->slug(10),
        'texto' => $faker->text(500),
        'imagen' => 'https://st2.depositphotos.com/3662505/6878/i/950/depositphotos_68789187-stock-photo-students.jpg',
        'keywords' => implode(' ', $faker->words(10)),
        'created_at' => $now,
        'updated_at' => $now
    ];
});


