<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class logincontroller extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request): RedirectResponse
        {
            $credentials = $request->validate([
                'user' => ['required'],
                'password' => ['required'],
            ]);
     
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
     
                return redirect()->intended('/');
            }
     
            return back()->with('loginError', 'Login Gagal (User atau Password salah)');
        }

        public function logout(Request $request): RedirectResponse
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
}
