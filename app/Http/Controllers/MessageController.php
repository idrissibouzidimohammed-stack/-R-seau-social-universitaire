<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])
            ->where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function create(User $user)
    {
        return view('messages.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'contenu' => $request->contenu,
            'lu' => false,
        ]);

        return redirect()->route('messages.index')->with('success', 'Message envoyé avec succès.');
    }
}