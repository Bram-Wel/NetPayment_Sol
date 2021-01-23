<?php

namespace App\Http\Livewire;

use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class UserSecrets extends Component
{

    public $username, $secret, $lastLoggedOut;

    public function mount()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
        $client = new Client($config);


        $query = (new Query('/ppp/secret/print'))
            ->where('name', $this->username);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $this->secret = $res['name'];
            $this->lastLoggedOut = $res['last-logged-out'];
        }
    }

    public function render()
    {
        return view('livewire.user-secrets');
    }
}
