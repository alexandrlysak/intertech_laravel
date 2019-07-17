<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
	$title = $faker->unique()->word;
    return [
        'title' => $title,
        'slug' => strtolower($title)
    ];
});
