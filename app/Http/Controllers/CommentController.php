<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationCustom;

class CommentController extends Controller
{
public function store(Request $request, Post $post)
{
    $request->validate([
        'contenu' => 'required|string|max:500',
    ]);

    Comment::create([
        'post_id' => $post->id,
        'user_id' => Auth::id(),
        'contenu' => $request->contenu,
    ]);

    if ($post->user_id !== Auth::id()) {
        NotificationCustom::create([
            'user_id' => $post->user_id,
            'type' => 'commentaire',
            'message' => Auth::user()->name . ' a commenté votre publication.',
            'lu' => false,
        ]);
    }

    return redirect()->back()->with('success', 'Commentaire ajouté');
}
}