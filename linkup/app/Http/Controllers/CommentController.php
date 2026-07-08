<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, Post $post)
{
    $request->validate([
        'content' => 'required|max:500',
    ]);

    $post->comments()->create([
        'content' => $request->input('content'),
        'user_id' => auth()->id(),
    ]);

    return back();
}
}
