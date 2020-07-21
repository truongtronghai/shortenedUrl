<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('1234567890'), // password
        'remember_token' => null,
        /**
         * 0 => system admin
         * 1 => guest (anonymous) // chi co 1 tai khoan loai nay de dung chung cho moi nguoi
         * 2 => signed-in guest // tai khoan dang ky mac dinh se la loai nay
         * 3 => premium
         * 4 => API1
         * 5 => API2
         */
        'role' => rand(2,5),
        'apis'=>0, // so lan goi api khi su dung loai tai khoan API
    ];
});
