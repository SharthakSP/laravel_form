<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'description'=>$faker->paragraph,
        'image'=>$faker->imageUrl(200,300)
    ];
});
