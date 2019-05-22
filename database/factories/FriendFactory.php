<?php

use App\Friend;
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

$factory->define(Friend::class, function (Faker $faker) {

    return [
        'from_id' => rand(2,20),
        'to_id' => rand(2,20),
        'created_at' => time(),
        'updated_at' => time(),
    ];
});
