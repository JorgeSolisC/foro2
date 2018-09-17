<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

/**
 * @property mixed title
 */
class CreatePostController extends Controller
{
    function create(){
        return view('posts.create');
    }

    function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
        ]);

        $post = new Post($request->all());
        auth()->user()->posts()->save($post);

        return "Post: ".$post->title;
    }
}
