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
        'imagen' => $faker->imageUrl(500, 500),
        'keywords' => implode(' ', $faker->words(10)),
        'created_at' => $now,
        'updated_at' => $now
    ];
});


