<?php

namespace App\Actions\Fortify;

use Carbon\Carbon;
use RouterOS\Query;
use App\Models\Team;
use App\Models\User;
use RouterOS\Client;
use RouterOS\Config;
use App\Models\Login;
use App\Models\Trial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make(
            $input,
            [
            'username' => ['required', 'string', 'max:100', 'unique:users', 'regex:/^[a-zA-Z]+$/u'],
            'phone' => ['required', 'string', 'max:10', 'min:10', 'unique:users', 'regex:/^0+[0-9]/'],
            'password' => $this->passwordRules(),
        ],
            [
            'username.regex' => 'Username should only contain letters.',
            'phone.regex' => 'Phone number must start with a zero.'
        ]
        )->validate();

        return DB::transaction(function () use ($input) {
            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD'),
                'port' => (int)env('MIKROTIK_PORT')
            ]);

            $client = new Client($config);
            $password = $input['password'];

            session(['ip' => $_SERVER['REMOTE_ADDR']]);

            // check username does not exist
            $query = (new Query('/ip/hotspot/user/print'))
                ->where('name', $input['username']);

            $response = $client->query($query)->read();

            $query = (new Query('/ip/hotspot/user/add'))
                ->equal('name', $input['username'])
                ->equal('server', env('MIKROTIK_HOTSPOT_SERVER'))
                ->equal('password', $password)
                ->equal('profile', env('MIKROTIK_TRIAL_PACKAGE'));

            $client->q($query)->read();

            $now = Carbon::now('Africa/Nairobi');

            // check if mac in trials table
            $end = $now->addMinutes(30);

            $date = date('M/d/Y', strtotime($end));
            $time = date('H:i:s', strtotime($end));
            $username = $input['username'];
            $source = "/ip hotspot active remove [find user=$username];
                /ip hotspot user set profile=0MBPS [find name=$username];
                /ip hotspot cookie remove [find user=$username];
                /system scheduler remove [find name=deactivate-$username];";

            $query = (new Query('/system/scheduler/add'))
                    ->equal('name', "deactivate-$username")
                    ->equal('start-date', $date)
                    ->equal('start-time', $time)
                    ->equal('interval', '00:01:00')
                    ->equal('on-event', $source);

            $response = $client->query($query)->read();

            $query = (new Query('/ip/hotspot/active/login'))
                    ->equal('ip', session()->get('ip'))
                    ->equal('user', "$username")
                    ->equal('pass', $input['password']);

            $response = $client->q($query)->read();

            return tap(User::create([
                'username' => $input['username'],
                'phone' => $input['phone'],
                'password' => $password,
                'type' => 'Hotspot'
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
