<?php


use App\RecipeTag;
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

$factory->define(RecipeTag::class, function (Faker $faker) {
    return [
        'recipe_id' => rand(1,300),
        'tag_id' => rand(1,5),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
