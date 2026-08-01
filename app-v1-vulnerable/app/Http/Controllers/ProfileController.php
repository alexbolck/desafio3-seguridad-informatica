<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function show($id)
    {
        // VULNERABLE: IDOR / Broken Access Control
        $user = User::findOrFail($id);
        return view('profile.show', compact('user'));
    }
}
