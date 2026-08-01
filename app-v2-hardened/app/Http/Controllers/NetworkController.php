<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function index()
    {
        return view('network.ping', ['output' => null, 'host' => '']);
    }

    public function ping(Request $request)
    {
        $host = $request->input('host');

        // FIX: RCE corregido; se valida el host y se usa escapeshellarg()
        if (!preg_match('/^(?:[a-zA-Z0-9.-]+)$/', $host)) {
            return back()->withErrors(['host' => 'Host inválido']);
        }

        $escapedHost = escapeshellarg($host);
        $output = shell_exec('ping -c 4 ' . $escapedHost);

        return view('network.ping', ['output' => $output, 'host' => $host]);
    }
}
