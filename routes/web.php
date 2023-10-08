<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServerController;

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

Route::resource('/servers', ServerController::class)->middleware('auth');
