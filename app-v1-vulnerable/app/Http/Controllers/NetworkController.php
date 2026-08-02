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

        // VULNERABLE: Remote Code Execution
        $output = shell_exec("ping -c 4 " . $request->host);

        return view('network.ping', ['output' => $output, 'host' => $host]);
    }
}
