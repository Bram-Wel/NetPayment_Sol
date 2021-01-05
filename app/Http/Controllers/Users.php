<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class Users extends Controller
{
    public function index()
    {
        $users = DB::table('users')->orderBy('id', 'desc')->paginate();

        return view('users', ['users' => $users]);
    }

    public function HotspotUsers()
    {
        $users = DB::table('users')
            ->where('type', 'hotspot')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('hotspot.users', ['users' => $users]);
    }

    public function EditHotspotUser($username)
    {
        return view('hotspot.users.edit', ['username' => $username]);
    }

    public function ActivateHotspotUser($username)
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ip/hotspot/user/print'))
            ->where('name', $username);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $id = $res['.id'];
            $query = (new Query('/ip/hotspot/user/enable'))
                ->equal('.id', $id);
            $response = $client->q($query)->read();
        }

        return redirect(route('hotspot-users'));
    }

    public function DeactivateHotspotUser($name)
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

        $query = (new Query('/ip/hotspot/user/print'))
            ->where('name', $name);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $id = $res['.id'];
            $query = (new Query('/ip/hotspot/user/active/remove'))
                ->equal('.id', $id);
            $client->q($query)->read();
        }

        $query = (new Query('/ip/hotspot/user/print'))
            ->where('name', $name);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $id = $res['.id'];
            $query = (new Query('/ip/hotspot/user/disable'))
                ->equal('.id', $id);
            $client->q($query)->read();
        }

        return redirect(route('hotspot-users'));
    }

    public function AddHotspotUser()
    {
        return view('hotspot.users.add');
    }
}
