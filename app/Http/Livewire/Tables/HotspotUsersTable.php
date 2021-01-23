<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class HotspotUsersTable extends LivewireDatatable
{
    public $model = User::class;

    public function builder()
    {
        return User::where('type', 'Hotspot');
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
            Column::name('email')->searchable(),
            Column::callback('username', function ($username) use ($client) {
                $query = (new Query('/ip/hotspot/user/print'))
                    ->where('name', $username);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['uptime'];
                }
            })->label('uptime'),
            Column::callback(['username', 'email'], function ($username) use ($client) {
                $query = (new Query('/ip/hotspot/user/print'))
                    ->where('name', $username);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    $gb = $res['bytes-in'] / 1024 / 1024 / 1024;
                    return number_format($gb, 2) . 'GB';
                }
            })->label('Data Used'),
            Column::callback(['username', 'phone'], function ($username) use ($client) {
                $query = (new Query('/ip/hotspot/user/print'))
                    ->where('name', $username);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['profile'];
                }
            })->label('Profile'),
        ];
    }
}
