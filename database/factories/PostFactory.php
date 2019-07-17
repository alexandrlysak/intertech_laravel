<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'thumbnail' => $faker->image('storage/app/public/images',400,300, null, false),
        'shortDescription' => $faker->realText(100),
        'fullDescription' => $faker->realText(2000),
        'author_id' => function () {
            $user = User::all()->random(1)->first();
            return $user->id;
        },
        'slug' => $faker->unique()->slug(),
        'views' => $faker->numberBetween(0, 20),
        'likes' => $faker->numberBetween(0, 20)
    ];
});
