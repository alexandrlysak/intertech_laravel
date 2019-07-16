<?php

use App\Answer;
use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 10)->create()->each(function($category) {
            factory(Post::class, rand(30, 50))->create([
                'category_id'=>$category->id
            ])->each(function($post) {
                factory(Comment::class, rand(2, 6))->create([
                    'post_id'=>$post->id
                ])->each(function($comment) {
                    factory(Answer::class, rand(1, 3))->create([
                        'comment_id'=>$comment->id
                    ]);
                });
            });
        });
    }
}