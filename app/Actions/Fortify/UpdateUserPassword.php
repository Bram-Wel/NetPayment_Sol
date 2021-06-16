<?php

namespace App\Actions\Fortify;

use RouterOS\Query;
use RouterOS\Client;
use RouterOS\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $input) {
            if ($input['current_password'] !== $user->password) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $config = new Config([
            'host'=>env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass'=>env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT')
        ]);

        $client = new Client($config);

        $query = (new Query('/ip/hotspot/user/print'))
            ->where('name', $user->username);

        $response = $client->query($query)->read();

        $query = (new Query('/ip/hotspot/user/set'))
            ->equal('.id', $response[0]['.id'])
            ->equal('password', $input['password']);

        $response = $client->query($query)->read();

        if (empty($response)) {
            $user->forceFill([
                'password' => $input['password'],
            ])->save();
        }
    }
}
