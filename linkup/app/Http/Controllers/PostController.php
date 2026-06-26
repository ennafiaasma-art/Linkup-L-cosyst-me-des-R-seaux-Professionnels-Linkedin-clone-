<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index()
    {
        // 1. Nzido 'with('user')' bach ndiro Eager Loading (katمنع n+1 problem f SQL)
        // 2. latest() kat-triyi l-posts mn l-jdid l-9dim (created_at DESC)
        $posts = Post::with('user')->latest()->get();

        // 3. n-sifto l-posts l l-vue li smيتها feed
        return view('feed', compact('posts'));
    }
}
