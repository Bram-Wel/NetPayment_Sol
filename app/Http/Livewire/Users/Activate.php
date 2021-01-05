<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class Activate extends Component
{
    public $username, $disabled;

    public function mount()
    {
        try {
            $config = new Config([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USERNAME'),
                'pass' => env('MIKROTIK_PASSWORD', ''),
                'port' => (int)env('MIKROTIK_PORT'),
            ]);
        } catch (ConfigException $e) {
            dd('configuration error');
        }
        try {
            $client = new Client($config);
        } catch (ClientException $e) {
            dd('exception');
        } catch (ConfigException $e) {
        } catch (QueryException $e) {
        }

        $query = (new Query('/ppp/secret/print'))
            ->where('name', $this->username);
        $response = $client->q($query)->read();
        foreach ($response as $res) {
            $this->disabled = $res['disabled'];
        }

    }

    public function render()
    {
        return view('livewire.users.activate');
    }
}
