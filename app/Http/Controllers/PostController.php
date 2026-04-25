<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments', 'likes'])
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->back();
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}