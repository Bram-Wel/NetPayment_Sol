<?php

namespace App\Actions\Fortify;

use RouterOS\Query;
use RouterOS\Client;
use RouterOS\Config;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make(
            $input,
            [
            'username' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z]+$/u', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:10', 'min:10', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
        ],
            [
            'username.regex' => 'Username should contain only letters.',
            'phone.regex' => 'Phone number must start with a zero.',
        ]
        )->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['phone'] !== $user->phone || $input['username'] !== $user->username) {

            if ($input['username'] !== $user->username) {
                $config = new Config([
                    'host' => env('MIKROTIK_HOST'),
                    'user' => env('MIKROTIK_USERNAME'),
                    'pass' => env('MIKROTIK_PASSWORD'),
                    'port' => (int)env('MIKROTIK_PORT')
                ]);

                $client = new Client($config);

                $query = (new Query('/ip/hotspot/user/print'))
                    ->where('name', $user->username);

                $response = $client->q($query)->r();

                $query = (new Query('/ip/hotspot/user/set'))
                    ->equal('.id', $response[0]['.id'])
                    ->equal('name', $input['username']);

                $response = $client->q($query)->r();

                if (empty($response)) {
                    $query = (new Query('/system/scheduler/print'))
                        ->where('name', "deactivate-" . $user->username);

                    $response = $client->q($query)->r();

                    if (count($response) > 0) {
                        $username = $input['username'];
                        $source = "/ip hotspot active remove [find user=$username];
                        /ip hotspot user set profile=0MBPS [find name=$username];
                        /ip hotspot cookie remove [find user=$username];
                        /system scheduler remove [find name=deactivate-$username];";

                        $query = (new Query('/system/scheduler/set'))
                            ->equal('.id', $response[0]['.id'])
                            ->equal('name', 'deactivate-' . $input['username'])
                            ->equal('on-event', $source);

                        $response = $client->q($query)->r();
                    }
                }
            }

            $user->forceFill([
                'username' => $input['username'],
                'phone' => $input['phone'],
            ])->save();
        }
    }
}
