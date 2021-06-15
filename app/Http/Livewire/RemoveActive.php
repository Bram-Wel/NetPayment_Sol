<?php

namespace App\Http\Livewire;

use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class RemoveActive extends Component
{

    public $userId;

    public function remove($userId)
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);

        $client = new Client($config);


        $query = (new Query('/ppp/active/remove'))
            ->equal('.id', $userId);

        $response = $client->q($query)->read();

        $this->redirect('/active');
    }

    public function render()
    {
        return view('livewire.remove-active');
    }
}
