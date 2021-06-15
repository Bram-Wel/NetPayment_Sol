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

        if ($input['phone'] !== $user->phone) {
            // $user->forceFill([
            //     'username' => $input['username'],
            //     'phone' => $input['phone'],
            // ])->save();


            if ($input['username'] !== $user->username) {
                $config = new Config([
                    'host' => env('MIKROTIK_HOST'),
                    'user' => env('MIKROTIK_USERNAME'),
                    'pass' => env('MIKROTIK_PASSWORD'),
                    'port' => (int)env('MIKROTIK_PORT')
                ]);

                $client = new Client($config);

                $query = (new Query('/ip/hotspot/user/print'))
                    ->where('name', $input['username']);

                $response = $client->q($query)->r();

                dd($response);
            }
        }
    }
}
