<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $data = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function indexAction()
    {
        $this->data['categories'] = Category::all();
        $posts = Post::orderBy('updated_at', 'desc')->take(3)->get();
    
        $this->data['posts'] = $posts;

        return view('frontend.main', $this->data);
    }
}
