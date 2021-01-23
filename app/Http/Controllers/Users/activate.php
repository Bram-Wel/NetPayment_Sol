<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class activate extends Controller
{
    public function index($username)
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ppp/secret/print'))
            ->where('name', $username);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $id = $res['.id'];
            $query = (new Query('/ppp/secret/enable'))
                ->equal('.id', $id);
            $response = $client->q($query)->read();
        }

        return redirect('/users');
    }
}
