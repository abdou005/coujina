<?php

use App\Recipe;
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

$factory->define(Recipe::class, function (Faker $faker) {
    $paths= [
                "/image-seed/recipes/r1.jpg",
                "/image-seed/recipes/r2.jpg",
                "/image-seed/recipes/r3.jpg",
                "/image-seed/recipes/r4.jpg",
                "/image-seed/recipes/r5.jpg",
                "/image-seed/recipes/r6.jpg",
                "/image-seed/recipes/r7.jpg",
                "/image-seed/recipes/r8.jpg",
                "/image-seed/recipes/r9.jpg",
                "/image-seed/recipes/r10.jpg",
                "/image-seed/recipes/r11.jpg",
                "/image-seed/recipes/r12.jpg",
                "/image-seed/recipes/r13.jpg",
                "/image-seed/recipes/r14.jpg",
                "/image-seed/recipes/r15.jpg",
                "/image-seed/recipes/r16.jpg",
                "/image-seed/recipes/r17.jpg",
                "/image-seed/recipes/r18.jpg",
                "/image-seed/recipes/r19.jpg",
                "/image-seed/recipes/r20.jpg",
                "/image-seed/recipes/r21.jpg",
                "/image-seed/recipes/r22.jpg",
                "/image-seed/recipes/r23.jpg",
                "/image-seed/recipes/r24.jpg",
                "/image-seed/recipes/r25.jpg",
                "/image-seed/recipes/r26.jpg",
                "/image-seed/recipes/r27.jpg",
                "/image-seed/recipes/r28.jpg",
                "/image-seed/recipes/r29.jpg",
                "/image-seed/recipes/r30.jpg",
                "/image-seed/recipes/r31.jpg",
                "/image-seed/recipes/r32.jpg",
        ];
//    $image = createImageRecipe($title, 'Recipe', 'recipes', '#f16821');
    $index = array_rand($paths, 1);
    $image = $paths[$index];
    return [
        'title' => $faker->text(100),
        'desc' => $faker->text,
        'image' => $image,
        'user_id' => rand(1,30),
        'created_at' => time(),
        'updated_at' => time(),
    ];
});
