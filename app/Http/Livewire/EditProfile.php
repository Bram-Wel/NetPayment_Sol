<?php

namespace App\Http\Livewire;

use Livewire\Component;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class EditProfile extends Component
{
    public $success, $profile, $remoteAddress, $rateLimit, $localAddress, $profileId;

    protected $rules = [
        'profile' => 'required|min:2',
        'rateLimit' => 'required',
        'remoteAddress' => 'required',
    ];

    public function mount()
    {
        $this->success = '';

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

        foreach ($response as $res) {
            $this->profileId = $res['.id'];
            $this->rateLimit = $res['rate-limit'];
            $this->remoteAddress = $res['remote-address'];
            $this->localAddress = $res['local-address'];
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $profileV = $this->validate();

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

        $query = (new Query('/ppp/profile/set'))
            ->equal('.id', $this->profileId)
            ->equal('local-address', $this->localAddress)
            ->equal('remote-address', $this->remoteAddress)
            ->equal('rate-limit', $this->rateLimit);

        $response = $client->q($query)->read();

        $this->success = 'Profile edited successfully';
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
