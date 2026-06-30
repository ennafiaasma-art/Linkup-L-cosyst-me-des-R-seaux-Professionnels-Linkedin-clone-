<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    //
    public function index()
    {

        $posts = Post::with('user')->latest()->get();


        // 3. n-sifto l-posts l l-vue li smيتها feed
        return view('feed', compact('posts'));
    }
}
