<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('detune.register', [
            "title" => 'Register'
        ]);
    }

    public function store(Request $request){
      
        $validatedData = $request->validate([
            'name' => 'required|max:225',
            'username' =>['required', 'min:3', 'max:255', 'unique:users'],
            'password' => 'min:6|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'min:6'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration Success! Please Login');
    }
}
