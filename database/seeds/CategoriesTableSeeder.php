<?php

use App\Category;
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
            ]);

        });
    }
}