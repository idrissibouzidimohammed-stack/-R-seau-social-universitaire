<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationCustom;

class LikeController extends Controller
{
   public function store(Post $post)
{
    // créer le like
    Like::firstOrCreate([
        'post_id' => $post->id,
        'user_id' => Auth::id(),
    ]);

    // 🔔 notification
    if ($post->user_id !== Auth::id()) {
        NotificationCustom::create([
            'user_id' => $post->user_id,
            'type' => 'like',
            'message' => Auth::user()->name . ' a aimé votre publication.',
            'lu' => false,
        ]);
    }

    return redirect()->back();
}
}