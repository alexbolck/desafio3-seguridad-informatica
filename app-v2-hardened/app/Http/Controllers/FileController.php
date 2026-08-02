<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        $files = \App\Models\FileModel::latest()->get();
        return view('files.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        // FIX: Validación de subida y nombre aleatorio seguro
        $file = $request->file('file');
        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads', $name, 'public');

        return redirect('/files')->with('success', 'Archivo subido: ' . $name);
    }
}
