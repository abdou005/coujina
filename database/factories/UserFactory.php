<?php

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    $paths= [
        "/image-seed/users/u1.jpg",
        "/image-seed/users/u2.jpg",
        "/image-seed/users/u3.jpg",
        "/image-seed/users/u4.jpg",
        "/image-seed/users/u5.jpg",
        "/image-seed/users/u6.jpg",
        ];
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $pathGenerate = generateAvatarByNameAndId($firstName, $lastName);
    $pathStatic = $paths[rand(0, 5)];
    $pathGenerateTab = [$pathGenerate, $pathStatic];
    $image = $pathGenerateTab[rand(0,1)];
    return [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'tel' => $faker->phoneNumber,
        'address' =>$faker->address,
        'image' => $image,
        'desc' => $faker->text,
        'role' => rand(User::SUBSCRIBER,User::LEADER),
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123456'),
        'created_at' => time(),
        'updated_at' => time(),
        'remember_token' => Str::random(10),
    ];
});
