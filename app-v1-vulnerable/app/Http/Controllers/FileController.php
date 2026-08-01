<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        return view('files.index');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $name, 'public');

        // VULNERABLE: Unrestricted file upload / no validation
        return redirect('/files')->with('success', 'Archivo subido: ' . $name);
    }
}
