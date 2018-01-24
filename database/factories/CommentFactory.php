<?php

use Faker\Generator as Faker;
use App\Models\User;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        //
        'content' => $faker->sentence(),
        'user_id' => User::inRandomOrder()->first(),
    ];
});
