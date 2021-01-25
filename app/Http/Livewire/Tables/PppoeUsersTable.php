<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class PppoeUsersTable extends LivewireDatatable
{
    public $model = User::class;

    public function builder()
    {
        return User::where('type', null);
    }

    public function columns()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT')
        ]);
        $client = new Client($config);
        return [
            NumberColumn::name('id'),
            Column::name('username')->searchable(),
            Column::name('phone')->searchable(),
            Column::callback('username', function ($username) use ($client) {
                $query = (new Query('/ppp/secret/print'))
                    ->where('name', $username);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['last-caller-id'];
                }
            })->label('mac address'),
            Column::callback(['username', 'phone'], function ($username) use ($client) {
                $query = (new Query('/ppp/secret/print'))
                    ->where('name', $username);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['last-logged-out'];
                }
            })->label('Last logged out'),
            Column::callback(['username', 'password'], function ($username) use ($client) {
                $query = (new Query('/ppp/secret/print'))
                    ->where('name', $username);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['profile'];
                }
            })->label('Profile'),

        ];
    }
}
