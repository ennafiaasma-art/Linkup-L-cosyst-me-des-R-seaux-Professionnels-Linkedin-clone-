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
}
