<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'posts' => Post::count(),
            'reports' => 0, // Placeholder
        ];

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.index', compact('stats', 'recentUsers'));
    }
}
