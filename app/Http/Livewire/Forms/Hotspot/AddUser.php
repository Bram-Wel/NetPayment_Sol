<?php

namespace App\Http\Livewire\Forms\Hotspot;

use App\Models\User;
use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class AddUser extends Component
{
    public $success, $name, $phone, $password, $profile;

    protected $rules = [
        'name' => 'required|string',
        'phone' => 'required|min:10|max:10|unique:users,phone',
        'password' => 'string|required',
        'profile' => 'required|required'
    ];

    public function add()
    {
        $this->validate();

        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT')
        ]);

        $client = new Client($config);

        $query = (new Query('/ip/hotspot/user/add'))
            ->equal('name', $this->name)
            ->equal('server', 'SERVER1')
            ->equal('password', $this->password)
            ->equal('profile', $this->profile);

        $response = $client->q($query)->read();

        $user = new User();
        $user->username = $this->name;
        $user->phone = $this->phone;
        $user->password = $this->password;
        $user->type = 'Hotspot';
        $user->save();


        session()->flash('message', 'User created successfully!');

        $this->redirect(route('hotspot-users'));
    }

    public function render()
    {
        return view('livewire.forms.hotspot.add-user');
    }
}
