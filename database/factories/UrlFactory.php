<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Url;
use Faker\Generator as Faker; // dung tao du lieu gia
use Illuminate\Support\Str; // dung tao string


$factory->define(Url::class, function (Faker $faker) {
    return [
        "shortened"=>Str::random(2),
        "url"=>$faker->url,
        "user_id"=>2, // guest role
    ];
});
