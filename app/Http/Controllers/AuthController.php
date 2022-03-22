<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');    
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        if(Auth::attempt($validateData)) {
            if(Auth::user()->role == 'owner') {
                return redirect()->route('owner.dashboard');
            } else {
                return redirect()->route('cashier.dashboard');
            }
        } else {
            return redirect()->route('login')->with('message','Email atau Password Tidak Sesuai!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return  redirect()->route('login');
    }
    
}
