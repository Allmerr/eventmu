<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\Studio\ServerController as StudioServerController;

Route::get('/login', [LoginController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/login', [LoginController::class, 'proccess_login'])->name('auth.proccess_login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'proccess_register'])->name('auth.proccess_register')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home.index');
})->name('home')->middleware('auth');

// make servers route with studio prefix
Route::prefix('studio')->group(function () {
    Route::resource('/servers', StudioServerController::class);
});


Route::resource('/servers', ServerController::class)->middleware('auth');
