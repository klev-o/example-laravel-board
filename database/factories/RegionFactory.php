<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Entity\Region::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->city,
        'slug' => Str::slug($name, '-', 'en'),
        'parent_id' => null,
    ];
});
