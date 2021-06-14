<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function home(Request $request) {
        if ($request->has('ip')) {
            $ip = $request->get('ip');

            // save ip in session
            session(['ip' => $ip]);

            if (\Illuminate\Support\Facades\Auth::check()) {
                $config = new Config([
                    'host' => env('MIKROTIK_HOST'),
                    'user' => env('MIKROTIK_USERNAME'),
                    'pass' => env('MIKROTIK_PASSWORD'),
                    'port' => (int)env('MIKROTIK_PORT')
                ]);

                $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id);
                $password = $user->password;

                $client = new Client($config);

                $query = (new Query('/ip/hotspot/user/print'))
                    ->where('name', \Illuminate\Support\Facades\Auth::user()->username);

                $response = $client->q($query)->read();

                foreach ($response as $res) {
                    $profile = $res['profile'];

                    if ($profile != '0MBPS') {
                        $query = (new Query('/ip/hotspot/active/login'))
                            ->equal('user', \Illuminate\Support\Facades\Auth::user()->username)
                            ->equal('pass', $password)
                            ->equal('ip', $request->ip);

                        $client->query($query)->read();
                    }
                }

                return redirect(route('dashboard'));
            } else {
                return view('auth.login');
            }
        } else {
            return redirect('http://auth.thetechglitch.net');
        }
    }
}
