<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    //
     public function store(User $user)
    {
        if ($user->id == auth()->id()) {
            return back();
        }

        auth()->user()->following()->syncWithoutDetaching($user->id);

        return back();
    }
   

public function toggle(User $user)
{
    if ($user->id == auth()->id()) {
        return back();
    }

    $authUser = auth()->user();

    if ($authUser->following()->where('following_id', $user->id)->exists()) {

        // Unfollow
        $authUser->following()->detach($user->id);

    } else {

        // Follow
        $authUser->following()->attach($user->id);

    }

    return back();
}
}
