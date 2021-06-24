<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Query;

class LoginController extends Controller
{
    public function checkLogin()
    {
        if (Auth::check()) {
            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD'),
                'port' => (int)env('MIKROTIK_PORT')
            ]);

            $user = User::find(Auth::user()->id);
            $password = $user->password;

            $client = new Client($config);

            $query = (new Query('/ip/hotspot/user/print'))
                ->where('name', Auth::user()->username);

            $response = $client->q($query)->read();

            foreach ($response as $res) {
                $profile = $res['profile'];

                if ($profile !== '0MBPS') {
                    $query = (new Query('/ip/hotspot/active/login'))
                        ->equal('user', Auth::user()->username)
                        ->equal('pass', $password)
                        ->equal('ip', request()->ip);

                    $client->query($query)->read();

                    // $login = new Login();
                    // $login->username = Auth::user()->username;
                    // $login->address = request()->ip;
                    // $login->mac = request()->mac;

                }
            }

            return redirect(route('dashboard'));
        }

        return view('auth.login');
    }

    /**
     * @throws ConfigException
     * @throws \RouterOS\Exceptions\QueryException
     */
    public function home(Request $request)
    {
        if ($request->has('ip') && env('APP_INSTALLATION') == 'DESKTOP') {
            // // save ip and mac in session
            // session(['ip' => $request->get('ip')]);
            // session(['mac' => $request->get('mac')]);

            $this->checkLogin();
        } elseif (!$request->has('ip') && env('APP_INSTALLATION') == 'DESKTOP'
        && $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            return view('auth.login');
        } elseif (env('APP_INSTALLATION') == 'VPS') {
            return view('auth.login');
        }

        return view('auth.login');
    }
}
