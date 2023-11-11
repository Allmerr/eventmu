<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\Studio\ServerController as StudioServerController;
use App\Http\Controllers\Studio\PostController as StudioPostController;
use App\Http\Controllers\Studio\StudioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VoteController;

// auth routes
Auth::routes();

// welcome route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// server routes
Route::group(['middleware' => ['auth']], function () {

    Route::get('/servers/{server}/follow', [FollowerController::class, 'follow'])->name('servers.follow');
    Route::get('/servers/{server}/unfollow', [FollowerController::class, 'unfollow'])->name('servers.unfollow');
    Route::get('/servers/{server}/page', [ServerController::class, 'page'])->name('servers.page');
    Route::get('/servers/{server}/page/{post}/detail', [ServerController::class, 'postDetail'])->name('servers.post_detail');
    Route::resource('/servers', ServerController::class)->only(['index', 'show']);
    Route::resource('/comment', CommentController::class)->only(['store', 'destroy', 'update']);
    Route::resource('/vote', VoteController::class)->only(['store']);

    // studio routes
    Route::get('/studio', [StudioController::class, 'index'])->name('studio.index');

    // studio server routes
    Route::name("studio.")->prefix("studio")->group(function () {
        Route::get('/servers/{server}/follower', [StudioServerController::class, 'follower'])->name('servers.follower');
        Route::resource('/servers', StudioServerController::class);
    });

    // studio server post routes
    Route::name("studio.servers.")->prefix("studio/servers")->group(function () {
        Route::get('/{server}/posts/{post}/votes', [StudioPostController::class, 'votes'])->name('posts.votes');
        Route::get('/{server}/posts/{post}/comments', [StudioPostController::class, 'comments'])->name('posts.comments');
        Route::get('/{server}/posts/{post}/comments/{comment}/reply', [StudioPostController::class, 'commentReply'])->name('posts.comment_reply');
        Route::resource('/{server}/posts', StudioPostController::class);
    });

});
