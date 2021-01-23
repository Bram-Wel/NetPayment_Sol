<?php

namespace App\Http\Livewire\Tables;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class PppoeProfilesTable extends LivewireDatatable
{
    public function builder()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT')
        ]);

        $client = new Client($config);

        $query = (new Query('/ppp/profile/print'));

        return $client->q($query)->read();
    }

    public function columns()
    {
       return [

       ];
    }
}
