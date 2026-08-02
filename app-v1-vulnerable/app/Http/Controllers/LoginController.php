<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $users = \App\Models\User::count();
        return view('login', compact('users'));
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // VULNERABLE: SQL Injection
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $users = DB::select($query);

        if (!empty($users)) {
            Session::put('user_id', $users[0]->id);
            return redirect('/profile/' . $users[0]->id);
        }

        return back()->withErrors(['email' => 'Credenciales inválidas']);
    }

    public function register(Request $request)
    {
        // VULNERABLE: Insecure password storage / weak hashing
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => md5($request->input('password')),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Usuario creado');
    }
}
