<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        // FIX: IDOR corregido con política de acceso basada en el usuario autenticado
        if (Auth::id() !== $user->id) {
            abort(403, 'No autorizado');
        }

        return view('profile.show', compact('user'));
    }
}
