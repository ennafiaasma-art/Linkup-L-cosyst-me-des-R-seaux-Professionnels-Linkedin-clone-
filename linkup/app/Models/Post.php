<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content', 'user_id', ]; // Bach n-goulou l Laravel hado y9dro yt-amodifiaw

public function user()
{
    return $this->belongsTo(User::class);
}
    //
}
