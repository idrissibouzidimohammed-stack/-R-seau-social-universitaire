<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::middleware(['auth'])->group(function () {

    // Profile Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts
    Route::resource('posts', PostController::class);

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Likes
    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'destroy'])->name('posts.unlike');

    // Follow
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create/{user}', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages/store/{user}', [MessageController::class, 'store'])->name('messages.store');

    // Users search
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

require __DIR__.'/auth.php';