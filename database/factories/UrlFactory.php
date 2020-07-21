<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Url;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Url::class, function (Faker $faker) {
    return [
        "shortened"=>Str::random(20),
        "url"=>$faker->url,
        "user_id"=>0
    ];
});
