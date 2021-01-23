<?php

namespace App\Http\Controllers;

use http\Env;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class activeUsers extends Controller
{
    public function index()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);

        $client = new Client($config);

        $query = (new Query('/ppp/active/print'));
        $users = $client->q($query)->read();

        return view('active', ['users' => $users]);
    }
}
