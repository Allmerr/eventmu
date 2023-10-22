<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\Studio\ServerController as StudioServerController;
use App\Http\Controllers\Studio\PostController as StudioPostController;
use App\Http\Controllers\Studio\StudioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;

// auth routes
Auth::routes();

// welcome route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// server routes
Route::get('/servers/{server}/follow', [FollowerController::class, 'follow'])->name('servers.follow');
Route::get('/servers/{server}/unfollow', [FollowerController::class, 'unfollow'])->name('servers.unfollow');
Route::resource('/servers', ServerController::class)->middleware('auth');

// studio routes
Route::get('/studio', [StudioController::class, 'index'])->name('studio.index')->middleware('auth');

// studio server routes
Route::name("studio.")->prefix("studio")->group(function () {
    Route::get('/servers/{server}/follower', [StudioServerController::class, 'follower'])->name('servers.follower');
    Route::resource('/servers', StudioServerController::class);
});

// studio server post routes
Route::name("studio.servers.")->prefix("studio/servers")->group(function () {
    Route::resource('/{server}/posts', StudioPostController::class);
});

