<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // FIX: SQL Injection corregido usando Auth::attempt() con credenciales seguras
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect('/profile/' . $user->id);
        }

        return back()->withErrors(['email' => 'Credenciales inválidas']);
    }

    public function register(Request $request)
    {
        // FIX: Almacenamiento seguro de password con Hash::make()
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Usuario creado');
    }
}
