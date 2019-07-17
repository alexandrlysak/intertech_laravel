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

    public function postAction(Request $request)
    {
        if(!$request->ajax()) {
            return $this->indexAction();
        }

        $requestData = $request->all();

        $visible = intval($requestData['visible']);
        $id = $requestData['id'];
        $sortDate = boolval($requestData['sortDate']);
        $sortViews = boolval($requestData['sortViews']);
        $sortLikes = boolval($requestData['sortLikes']);

        switch ($requestData['entity']) {

            case 'mainPage':

                $posts = Post::orderBy('updated_at', 'desc')->take(3)->get();

                break;

            case 'categoryPage':
                break;

            case 'authorPage':
                break;

            case 'tagPage':
                break;

            default:
                return response()->json([
                    'code' => 0
                ]);
                break;
        }

        return response()->json([
            'code' => 1,
            'html' => view('frontend.layouts.postsList', ['posts' => $posts])->render()
        ]);
    }
}
