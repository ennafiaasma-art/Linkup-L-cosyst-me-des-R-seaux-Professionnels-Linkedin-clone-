<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
      public function toggle(Post $post)
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('post_id', $post->id)
                    ->first();

        if ($like) {

            // Supprimer le like
            $like->delete();

        } else{

            // Ajouter le like
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);

        }
        return back();
    }
}
