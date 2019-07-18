<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use App\User;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $data = [];

    public function postsAction($id)
    {
        if (!$id || $id == '') {
            abort(404);
        }

        $user = User::where(['id' => $id])->first();
        if (!$user) {
            abort(404);
        }

        $posts = Post::where(['author_id' => $user->id])->paginate(3);
        $categories = Category::all();

        $this->data['posts'] = $posts;
        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Author',
            'page' => 'authorPage',
            'title' => $user->name,
            'id' => $user->id
        ];
        return view('frontend.posts', $this->data);
    }
}
