<?php

namespace App\Http\Controllers;

use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class Profiles extends Controller
{
    public function index()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD', ''),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ppp/profile/print'));
        $response = $client->q($query)->read();
        return view('profiles', ['profiles' => $response]);
    }

    public function ShowHotspotProfiles()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD', ''),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ip/hotspot/user/profile/print'));
        $response = $client->q($query)->read();

        return view('profiles.hotspot', ['profiles' => $response]);
    }

    public function HotspotProfileAdd()
    {
        return view('hotspot.profiles.add');
    }

    public function HotspotProfileEdit($id)
    {
        return view('hotspot.profiles.edit', ['profileID' => $id]);
    }

    public function HotspotProfileDelete($id)
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD', ''),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ip/hotspot/user/profile/remove'))
            ->equal('.id', $id);

        $response = $client->q($query)->read();

        return redirect(route('hotspot-profiles'));
    }
}
