<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(100),
        'author_id' => function () {
            $user = User::all()->random(1)->first();
            return $user->id;
        }
    ];
});
