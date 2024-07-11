<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role=='admin'){
                return redirect()->intended('/dashboard');
            }else if(Auth::user()->role=='nasabah'){
                return redirect()->intended('/dashboard-nasabah');
            }
        }

        // dd('berhasil login');
        return back()->with('loginError', 'Login gagal silahkan cek Username/Password!');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
