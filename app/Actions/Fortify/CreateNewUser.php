<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

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
        Validator::make($input, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {

            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD'),
                'port' => (int)env('MIKROTIK_PORT')
            ]);

            $client = new Client($config);
            $password = $input['password'];

            $query = (new Query('/ip/hotspot/user/add'))
                ->equal('name', $input['username'])
                ->equal('server', 'all')
                ->equal('password', $password)
                ->equal('profile', '2MBPS')
                ->equal('comment', $input['username']);

            $client->q($query)->read();

            $now = Carbon::now('Africa/Nairobi');
            $end = $now->addMinutes(5);

            $date = date('M/d/Y', strtotime($end));
            $time = date('H:i:s', strtotime($end));
            $username = $input['username'];
            $source = "/ip hotspot active remove [find user=\"$username\"]; /ip hotspot user set profile=0MBPS [find name=\"$username\"]; /ip hotspot cookie remove [find user=\"$username\"];";

            $query = (new Query('/system/scheduler/add'))
                ->equal('name', 'deactivate-' . "$username")
                ->equal('start-date', $date)
                ->equal('start-time', $time)
                ->equal('on-event', $source);

            $response = $client->query($query)->read();

            $query = (new Query('/ip/hotspot/active/login'))
                ->equal('ip', session()->get('ip'))
                ->equal('name', "$username")
                ->equal('password', $input['password']);

            $response = $client->q($query)->read();

            return tap(User::create([
                'username' => $input['username'],
                'phone' => $input['phone'],
                'password' => $password,
                'type' => 'hotspot'
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
