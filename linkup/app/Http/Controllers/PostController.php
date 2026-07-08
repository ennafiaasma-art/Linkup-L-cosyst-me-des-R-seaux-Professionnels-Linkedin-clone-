<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Afficher tous les posts
    public function index()
    {
       $posts = Post::with([
    'user',
    'likes',
    'comments.user'
])->latest()->get();

        return view('feed', compact('posts'));
    }

    // Ajouter un post
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('feed')
            ->with('success', 'Post publié avec succès.');
    }

    // Formulaire de modification


    // Modifier un post
    public function update(Request $request, Post $post)
    {
        if ($post->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $post->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('feed')
            ->with('success', 'Post modifié.');
    }

    // Supprimer un post
    public function destroy(Post $post)
    {
        if ($post->user_id != auth()->id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('feed')
            ->with('success', 'Post supprimé.');
    }
}
