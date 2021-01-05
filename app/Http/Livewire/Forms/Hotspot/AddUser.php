<?php

namespace App\Http\Livewire\Forms\Hotspot;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class AddUser extends Component
{
    public $success, $username, $phone, $email, $password, $profile;

    protected $rules = [
        'username' => 'required|string',
        'phone' => 'required|min:10|max:10',
        'email' => 'email|required',
        'password' => 'string|required|min:8',
        'profile' => 'required|required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $this->validate();

        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'password' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT')
        ]);

        $client = new Client($config);

        $password = Hash::make($this->password);

        $query = (new Query('/ip/hotspot/user/profile/add'))
            ->equal('name', $this->name)
            ->equal('pool', 'dhcp')
            ->equal('shared-users', 1)
            ->equal('rate-limit', '0M/0M');

        $response = $client->q($query)->read();

        $query = (new Query('/ip/hotspot/user/add'))
            ->equal('name', $this->username)
            ->equal('server', 'all')
            ->equal('password', $password)
            ->equal('profile', $this->profile);
    }

    public function render()
    {
        return view('livewire.forms.hotspot.add-user');
    }
}
