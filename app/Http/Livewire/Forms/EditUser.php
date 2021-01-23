<?php

namespace App\Http\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class EditUser extends Component
{
    public $username, $profile, $password, $success, $phone, $email, $userId;
    protected $rules = [
        'username' => 'required',
        'profile' => 'required',
        'password' => 'required|min:5',
        'phone' => 'bail|required',
        'email' => 'bail|email|required'
    ];

    public function mount()
    {
        $this->success = '';

        try {
            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD'),
                'port' => (int)env('MIKROTIK_PORT'),
            ]);
        } catch (ConfigException $e) {
            dd('configuration error');
        }
        try {
            $client = new Client($config);
        } catch (ClientException $e) {
            dd($e);
        } catch (ConfigException $e) {
        } catch (QueryException $e) {
        }

        $query = (new Query('/ppp/secret/print'))
            ->where('name', $this->username);

        $response = $client->q($query)->read();

        foreach ($response as $res) {
            $this->userId = $res['.id'];
            $this->profile = $res['profile'];
        }

        $result = DB::table('users')->where('username', $this->username)->value('id');
        $user = User::find($result);

        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit()
    {
        $userV = $this->validate();

        $result = DB::table('users')->where('username', $this->username)->value('id');
        $user = User::find($result);

        $checkEmail = $checkPhone = 0;

        if ($user->wasChanged('email')) {
            $checkEmail = DB::table('users')
                ->where('email', $this->email)->count();
        }

        if ($user->wasChanged('phone')) {
            $checkPhone = DB::table('users')
                ->where('phone', $this->phone)->count();
        }

        if ($user->wasChanged('email')) {
            if ($checkEmail != 0) {
                $this->addError('email', 'Email already exists');
                $this->success = null;
            }
        }

        if ($user->wasChanged('phone')) {
            if ($checkPhone != 0) {
                $this->addError('phone', 'Phone already exists');
                $this->success = null;
            }
        }

        if ($checkEmail == 0 && $checkPhone == 0) {
            $user->phone = $this->phone;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->username = $this->username;
            $user->save();

            try {
                $config = new Config([
                    'host' => env('MIKROTIK_HOST'),
                    'user' => env('MIKROTIK_USERNAME'),
                    'pass' => env('MIKROTIK_PASSWORD'),
                    'port' => (int)env('MIKROTIK_PORT'),
                ]);
            } catch (ConfigException $e) {
                dd('configuration error');
            }
            try {
                $client = new Client($config);
            } catch (ClientException $e) {
                dd($e);
            } catch (ConfigException $e) {
            } catch (QueryException $e) {
            }

            $query = (new Query('/ppp/secret/set'))
                ->equal('.id', $this->userId)
                ->equal('profile', $this->profile)
                ->equal('password', $this->password);

            $client->q($query)->read();

            $this->success = 'User edited successfully';
        }
    }

    public function render()
    {
        return view('livewire.forms.edit-user');
    }
}
