<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "role" => "nasabah"
        ];

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        // $request->session()->flash('succes', 'Registration successfull!');

        return redirect()->route('login')->with('succes', 'Registration successfull!');
    }
}
