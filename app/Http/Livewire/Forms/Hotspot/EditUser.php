<?php

namespace App\Http\Livewire\Forms\Hotspot;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class EditUser extends Component
{
    public $success, $username, $phone, $email, $password, $profile, $userID, $userId;
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
        'phone' => 'required|',
        'profile' => 'required|string',
    ];

    public function mount()
    {
        $response = DB::table('users')
            ->where('username', $this->username)
            ->get();

        foreach ($response as $res) {
            $this->username = $res->username;
            $this->phone = $res->phone;
            $this->email = $res->email;
            $this->userID = $res->id;

            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD'),
                'port' => (int)env('MIKROTIK_PORT')
            ]);

            $client = new Client($config);
            $query = (new Query('/ip/hotspot/user/print'))
                ->where('name', $res->username);

            $response = $client->q($query)->read();
            foreach ($response as $resp) {
                $this->profile = $resp->profile;
                $this->userId = $resp['.id'];
            }
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit()
    {
        $this->validate();
        $user = User::find($this->userID);

        $password = Hash::make($this->password);
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
            $user->update();

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
                ->equal('password', $password);

            $client->q($query)->read();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'User edited successfully']);
        }
    }

    public function render()
    {
        return view('livewire.forms.hotspot.edit-user');
    }
}
