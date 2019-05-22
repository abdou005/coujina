<?php

use App\Competition;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(Competition::class, function (Faker $faker) {
    $image = generateAvatarByNameAndId($faker->lastName, $faker->firstName);
    return [
        'name' => $faker->text(10),
        'type' => rand(Competition::AMATEUR, Competition::PROFESSIONAL),
        'image' => $image,
        'address' =>$faker->address,
        'desc' => $faker->text,
        'start_at' => $faker->unixTime,
        'end_at' => $faker->unixTime,
        'created_at' => time(),
        'updated_at' => time(),
    ];
});
