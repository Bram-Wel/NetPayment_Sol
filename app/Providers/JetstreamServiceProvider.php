<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Fortify::authenticateUsing(function (Request $request) {
            $count = DB::table('users')->where('username', $request->username)->count();
            if ($count > 0) {
                $response = DB::table('users')->where('username', $request->username)->value('id');
                $user = User::find($response);
                $password = $request->password;
                $dbPass = $user->password;
                if ($password == $dbPass) {
                    $config = new Config([
                        'host' => env('MIKROTIK_HOST'),
                        'user' => env('MIKROTIK_USERNAME'),
                        'pass' => env('MIKROTIK_PASSWORD'),
                        'port' => (int)env('MIKROTIK_PORT')
                    ]);

                    $client = new Client($config);

                    $query = (new Query('/ip/hotspot/user/print'))
                        ->where('name', $request->username);

                    $response = $client->q($query)->read();

                    foreach ($response as $res) {
                        $profile = $res['profile'];

                        if ($profile != '0MBPS') {
                            $query = (new Query('/ip/hotspot/active/login'))
                                ->equal('ip', session()->get('ip'))
                                ->equal('user', $request->username)
                                ->equal('password', $request->password);

                            $response = $client->q($query)->read();
                            dd($response);
                        }
                    }

                    return $user;
                } else {
                    return null;
                }
            } else {
                return null;
            }

        });
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', __('Administrator'), [
            'create',
            'read',
            'update',
            'delete',
        ])->description(__('Administrator users can perform any action.'));

        Jetstream::role('editor', __('Editor'), [
            'read',
            'create',
            'update',
        ])->description(__('Editor users have the ability to read, create, and update.'));
    }
}
