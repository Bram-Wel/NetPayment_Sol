<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class deactivate extends Controller
{
    public function index($name)
    {
        try {
            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD'),
                'port' => (int)env('MIKROTIK_PORT'),
            ]);
        } catch (ConfigException $e) {
            dd('configuration error');
        }
        try {
            $client = new Client($config);
        } catch (ClientException $e) {
            dd($e);
        } catch (ConfigException $e) {
        } catch (QueryException $e) {
        }

        $query = (new Query('/ppp/active/print'))
            ->where('name', $name);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $id = $res['.id'];
            $query = (new Query('/ppp/active/remove'))
                ->equal('.id', $id);
            $client->q($query)->read();
        }

        $query = (new Query('/ppp/secret/print'))
            ->where('name', $name);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $id = $res['.id'];
            $query = (new Query('/ppp/secret/disable'))
                ->equal('.id', $id);
            $client->q($query)->read();
        }

        return redirect('/users');
    }
}
