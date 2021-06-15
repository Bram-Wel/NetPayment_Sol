<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class AddProfile extends Component
{
    public $success, $profile, $remoteAddress, $rateLimit, $localAddress;
    protected $rules = [
        'profile' => 'required|min:2',
        'rateLimit' => 'required',
        'remoteAddress' => 'required',
    ];

    public function mount()
    {
        $this->success = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $profile = $this->validate();

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

        $query = (new Query('/ppp/profile/print'))
            ->where('name', $this->profile);

        $response = $client->q($query)->read();

        $count = count($response);
        if ($count == 0) {
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

            $query = (new Query('/ppp/profile/add'))
                ->equal('name', $this->profile)
                ->equal('local-address', $this->localAddress)
                ->equal('remote-address', $this->remoteAddress)
                ->equal('rate-limit', $this->rateLimit);

            $response = $client->q($query)->read();

            $this->success = 'Profile added successfully';
        } else {
            $this->addError('profile', 'Profile with this name already exists!');
            $this->success = null;
        }
    }

    public function render()
    {
        return view('livewire.forms.add-profile');
    }
}
