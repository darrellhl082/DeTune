<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('detune.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required|min:3|max:255',
            'password' => 'required|min:5|max:255'
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->with('loginFailed', 'Login Failed');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('login');
    }
}
