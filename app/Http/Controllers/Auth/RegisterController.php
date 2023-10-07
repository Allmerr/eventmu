<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function proccess_register(Request $request){
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255|confirmed',
        ];

        $validatedData = $request->validate($rules);

        User::create($validatedData);

        // with message
        return redirect()->route('auth.login')->with('success', 'Your account has been created!');
    }
}
