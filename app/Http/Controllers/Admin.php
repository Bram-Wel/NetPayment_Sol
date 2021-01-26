<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class Admin extends Controller
{
    public function index()
    {
        if (Auth::user()->admin == 1) {
            $totalUsers = DB::table('users')->count();
            $newUsers = DB::table('users')->whereMonth('created_at', date('m'))->count();

            return view('admin', ['totalUsers' => $totalUsers, 'newUsers' => $newUsers]);
        } else {
            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD'),
                'port' => (int)env('MIKROTIK_PORT')
            ]);

            $client = new Client($config);
            $name = Auth::user()->name;

            $query = (new Query('/ip/hotspot/user/print'))
                ->where('name', $name);

            $response = $client->q($query)->read();
            foreach ($response as $res) {
                if ($res['name'] != 'default-trial') {
                    $package = $res['profile'];
                    if ($package == '0MBPS') {
                        $message = "<span class='text-red-400 font-bold'>Not Subscribed</span>";
                    } else {
                        $message = "<span class='text-green-400 font-bold'>$package</span>";
                    }
                }
            }

            return view('dashboard', ['message' => $message, 'package' => $package]);
        }
    }
}
