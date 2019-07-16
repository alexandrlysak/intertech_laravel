<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();
        Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(2, 6))->pluck('id')->toArray()
            );
        });
    }
}
