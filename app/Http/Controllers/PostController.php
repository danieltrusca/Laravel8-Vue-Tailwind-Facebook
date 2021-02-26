<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Friend;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        $friends=Friend::friendships();

        if ($friends->isEmpty()) {
            return new PostCollection(request()->user()->posts);
        }

        return new PostCollection(
            Post::whereIn('user_id', [$friends->pluck('user_id'), $friends->pluck('friend_id')])
                ->get()
        );
        // return new PostCollection(Post::all());
        //return new PostCollection(request()->user()->posts);
    }


    public function store()
    {
        $data=request()->validate([
            'body'=>''
        ]);

        $post = request()->user()->posts()->create($data);

        return new PostResource($post);
    }
}
