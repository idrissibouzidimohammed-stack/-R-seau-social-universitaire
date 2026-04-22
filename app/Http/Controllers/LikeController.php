<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        Like::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        Like::where('post_id', $post->id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back();
    }
}