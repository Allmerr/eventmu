<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/login', [LoginController::class, 'proccess_login'])->name('auth.proccess_login');
Route::get('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'proccess_register'])->name('auth.proccess_register');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home.index');
})->name('home')->middleware('auth');
