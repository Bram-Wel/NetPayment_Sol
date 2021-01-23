<?php

namespace App\Http\Livewire\Hotspot\Profile;

use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class Add extends Component
{
    public $name, $shared_users, $pool, $limit;

    protected $rules = [
        'name' => 'required|string',
        'shared_users' => 'required|integer',
        'pool' => 'required|string',
        'limit' => 'required|integer'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveProfile()
    {
        $this->validate();

        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD', ''),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ip/hotspot/user/profile/add'))
            ->equal('name', $this->name)
            ->equal('address-pool', $this->pool)
            ->equal('idle-timeout', '00:05:00')
            ->equal('rate-limit', $this->limit . 'M/' . $this->limit . 'M')
            ->equal('shared-users', $this->shared_users);

        $response = $client->q($query)->read();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Profile added successfully!']);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.hotspot.profile.add');
    }
}
