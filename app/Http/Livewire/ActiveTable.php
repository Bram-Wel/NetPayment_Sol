<?php

namespace App\Http\Livewire;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class ActiveTable extends LivewireDatatable
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
            Column::callback('username', function ($username) use ($client) {
                $query = (new Query('/ip/hotspot/active/print'))
                    ->where('user', $username);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['address'];
                }

            })->label('Address'),
            Column::callback(['username', 'phone'], function ($user) use ($client) {
                $query = (new Query('/ip/hotspot/active/print'))
                    ->where('user', $user);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['uptime'];
                }
            })->label('uptime'),
            Column::callback(['username', 'phone', 'id'], function ($user) use ($client) {
                $query = (new Query('/ip/hotspot/active/print'))
                    ->where('user', $user);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['mac-address'];
                }
            })->label('Mac Address'),
            Column::callback(['username', 'created_at'], function ($user, $email) use ($client) {
                $query = (new Query('/ip/hotspot/user/print'))
                    ->where('name', $user);

                $response = $client->q($query)->read();
                foreach ($response as $res) {
                    return $res['profile'];
                }
            })->label('Package')
        ];
    }
}
