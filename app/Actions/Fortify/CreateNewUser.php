<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
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
            'email' => ['required', 'email', 'max:255', 'unique:users'],
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
                ->equal('profile', '0MBPS')
                ->equal('comment', $input['username']);

            $client->q($query)->read();

            return tap(User::create([
                'email' => $input['email'],
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
