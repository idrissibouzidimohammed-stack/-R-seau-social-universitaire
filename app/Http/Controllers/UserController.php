<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->q;

        $users = User::with(['followers'])
        ->when($query, function ($qBuilder) use ($query) {
            $qBuilder->where('name', 'like', "%{$query}%")
             ->orWhere('prenom', 'like', "%{$query}%");
        })
        ->get();

        return view('users.index', compact('users', 'query'));
    }

    public function show(User $user)
    {
        $user->load('posts', 'followers', 'following');

        return view('users.show', compact('user'));
    }
}