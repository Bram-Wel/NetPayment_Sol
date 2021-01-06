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

class AddUser extends Component
{
    public $username, $profile, $password, $success, $phone, $email;
    protected $rules = [
        'username' => 'required',
        'profile' => 'required',
        'password' => 'required|min:5',
        'phone' => 'required|unique:users',
        'email' => 'nullable|email|unique:users'
    ];

    public function mount()
    {
        $this->success = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $user = $this->validate();

        $checkName = DB::table('users')
            ->where('username', $this->username)->count();
        $checkEmail = DB::table('users')
            ->where('email', $this->email)->count();
        $checkPhone = DB::table('users')
            ->where('phone', $this->phone)->count();

        if ($checkName != 0) {
            $this->addError('username', 'Username already exists');
            $this->success = null;
        }

        if ($checkEmail != 0) {
            $this->addError('email', 'Email already exists');
            $this->success = null;

        }
        if ($checkPhone != 0) {
            $this->addError('phone', 'Phone already exists');
            $this->success = null;

        }

        if ($checkEmail == 0 && $checkName == 0 && $checkPhone == 0) {
            $user = new User;

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

            $query = (new Query('/ppp/secret/add'))
                ->equal('name', $this->username)
                ->equal('profile', $this->profile)
                ->equal('password', $this->password)
                ->equal('service', 'pppoe');

            $client->q($query)->read();
            session()->forget('message');
            session()->flash('message', 'User added successfully!');
            $this->redirect(route('Users'));

        }
    }

    public function render()
    {
        return view('livewire.forms.add-user');
    }
}
