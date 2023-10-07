<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function proccess_login(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8|max:255',
        ];

        $validatedData = $request->validate($rules);

        if (auth()->attempt($validatedData)) {
            return redirect()->route('home');
        }

        return redirect()->route('auth.login')->with('error', 'Your credentials are invalid!');
    }

    public function logout(Request $request){
        auth()->logout();

        return redirect()->route('auth.login')->with('success', 'You have been logged out!');
    }
}
