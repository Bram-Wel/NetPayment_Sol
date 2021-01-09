<?php

namespace App\Http\Livewire;

use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class ActiveUsers extends Component
{
    public $activeUsers;

    public function mount()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ppp/active/print'));
        $response = $client->q($query)->read();
        $this->activeUsers = count($response);
    }

    public function activeUsers()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);

        $query = (new Query('/ppp/active/print'));
        $response = $client->q($query)->read();
        $this->activeUsers = count($response);
    }

    public function render()
    {
        return view('livewire.active-users');
    }
}
