<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        echo "seed Admin\n";
        $firstName = 'Admin';
        $lastName = 'Bo';
        $image = generateAvatarByNameAndId($firstName, $lastName);
        DB::table('users')->insert([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'tel' => '01235162626',
            'address' =>'adresse',
            'image' => $image,
            'desc' => 'description',
            'role' => \App\User::ADMIN,
            'email' => 'koujinaadmin@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => time(),
            'updated_at' => time(),
            'remember_token' => Str::random(10),
        ]);
        echo "seed users\n";
        factory(App\User::class, 50)->create();
        echo "seed friends\n";
        factory(App\Friend::class, 300)->create();
        echo "seed recipes\n";
        factory(App\Recipe::class, 300)->create();
        echo "seed likes\n";
        factory(App\LikeRecipe::class, 800)->create();
        echo "seed tags recipe\n";
        factory(App\RecipeTag::class, 800)->create();
        echo "seed comments\n";
        factory(App\Comment::class, 800)->create();
        echo "seed competitions\n";
        factory(App\Competition::class, 5)->create();
    }
}
