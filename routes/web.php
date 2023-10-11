<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\Studio\ServerController as StudioServerController;
use App\Http\Controllers\Studio\StudioController;
use App\Http\Controllers\FollowerController;

// welcome route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// auth routes
Route::get('/login', [LoginController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/login', [LoginController::class, 'proccess_login'])->name('auth.proccess_login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'proccess_register'])->name('auth.proccess_register')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth');

// home route
Route::get('/home', function () {
    return view('home.index');
})->name('home')->middleware('auth');

// server routes
Route::get('/servers/{server}/follow', [FollowerController::class, 'follow'])->name('servers.follow');
Route::resource('/servers', ServerController::class)->middleware('auth');

// studio routes
Route::get('/studio', [StudioController::class, 'index'])->name('studio.index')->middleware('auth');

// studio server routes
Route::name("studio.")->prefix("studio")->group(function () {
    Route::resource('/servers', StudioServerController::class);
});
