<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class CheckPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if user has made a payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \RouterOS\Exceptions\QueryException
     */
    public function handle()
    {
        $result = DB::connection('mysql2')->table('payments')
            ->where('checked', '=', 0)
            ->count();

        if ($result > 0) {
            $result = DB::connection('mysql2')->table('payments')
                ->where('checked', '=', 0)
                ->get();

            foreach ($result as $payment) {
                $p = $payment->phone;
                $name = User::where('phone', $p)->value('username');
                $amount = DB::connection('mysql2')->table('payments')
                    ->where('phone', $p)
                    ->where('checked', 0)
                    ->value('amount');

                $config = new Config([
                    'host' => env('MIKROTIK_HOST'),
                    'user' => env('MIKROTIK_USERNAME'),
                    'pass' => env('MIKROTIK_PASSWORD'),
                    'port' => (int)env('MIKROTIK_PORT'),
                ]);

                date_default_timezone_set('Africa/Nairobi');

                if ($amount == 30) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addDay();
                    $rate = '1MBPS';
                } elseif ($amount == 40) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addDay();
                    $rate = '2MBPS';
                } elseif ($amount == 50) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addDay();
                    $rate = '3MBPS';
                } elseif ($amount == 65) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addDay();
                    $rate = '4MBPS';
                } elseif ($amount == 85) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addDay();
                    $rate = '5MBPS';
                } elseif ($amount == 180) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addWeek();
                    $rate = '1MBPS';
                } elseif ($amount == 300) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addWeek();
                    $rate = '2MBPS';
                } elseif ($amount == 380) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addWeek();
                    $rate = '3MBPS';
                } elseif ($amount == 500) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addWeek();
                    $rate = '4MBPS';
                } elseif ($amount == 650) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addWeek();
                    $rate = '5MBPS';
                } elseif ($amount == 700) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addMonth();
                    $rate = '1MBPS';
                } elseif ($amount == 1200) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addMonth();
                    $rate = '2MBPS';
                } elseif ($amount == 1500) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addMonth();
                    $rate = '3MBPS';
                } elseif ($amount == 2000) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addMonth();
                    $rate = '4MBPS';
                } elseif ($amount == 2500) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addMonth();
                    $rate = '5MBPS';
                }

                $time = date('H:i:s', strtotime($date));
                $date = date('M/d/Y', strtotime($date));

                $client = new Client($config);
                $type = User::where('phone', $p)->value('type');
                if ($type == 'hotspot') {
                    $password = DB::table('users')
                        ->where('phone', $p)
                        ->value('password');

                    $phone = '254' . ltrim($p, '0');

                    $ip = DB::connection('mysql2')->table('ips')
                        ->where('phone', $phone)
                        ->orderBy('id', 'desc')
                        ->limit(1)
                        ->value('address');

                    $query = (new Query('/ip/hotspot/user/print'))
                        ->where('name', $name);

                    $user = $client->query($query)->read();
                    foreach ($user as $use) {
                        $id = $use['.id'];
                        $query =
                            (new Query('/ip/hotspot/user/set'))
                                ->equal('.id', $id)
                                ->equal('profile', $rate);
                        $client->query($query)->read();
                    }

                    $query = (new Query('/ip/hotspot/active/login'))
                        ->equal('ip', $ip)
                        ->equal('user', $name)
                        ->equal('password', $password);

                    $client->query($query)->read();

                    $source = "/ip hotspot user set [find name=\"$name\"] profile=0MBPS; /ip hotspot active remove [find user=\"$name\"]; /ip hotspot cookie remove [find user=\"$name\"]; /system scheduler remove [find name=\"deactivate-$name\"];";

                    $query = (new Query('/system/scheduler/print'))
                        ->where('name', "$name");

                    $response = $client->query($query)->read();

                    if (!empty($response)) {
                        foreach ($response as $scheduler) {
                            $id = $scheduler['.id'];
                            $query = (new Query('/system/scheduler/remove'))
                                ->equal('.id', "$id");

                            $response = $client->query($query)->read();

                            if (empty($response)) {
                                $query =
                                    (new Query('/system/scheduler/add'))
                                        ->equal('name', "deactivate-$name")
                                        ->equal('start-date', "$date")
                                        ->equal('start-time', "$time")
                                        ->equal('start-time', '00:01:00')
                                        ->equal('on-event', "$source");
                                $client->query($query)->read();
                            }
                        }
                    } else {
                        $query =
                            (new Query('/system/scheduler/add'))
                                ->equal('name', "deactivate-$name")
                                ->equal('start-date', "$date")
                                ->equal('start-time', "$time")
                                ->equal('interval', '00:01:00')
                                ->equal('on-event', "$source");
                        $client->query($query)->read();
                    }
                } else {
                    $query = (new Query('/ppp/secret/print'))
                        ->where('name', $name);

                    $response = $client->query($query)->read();
                    foreach ($response as $res) {
                        $id = $res['.id'];

                        $query = (new Query('/ppp/secret/set'))
                            ->equal('.id', $id)
                            ->equal('profile', $rate);

                        $client->query($query)->read();

                        $query = (new Query('/ppp/secret/enable'))
                            ->equal('.id', $id);

                        $client->query($query)->read();

                        $source = "/ppp secret disable find[name='$name']";

                        $query = (new Query('/system/scheduler/print'))
                            ->where('name', 'deactivate-' . $name);

                        $response = $client->query($query)->read();

                        if (count($response) > 0) {
                            foreach ($response as $resp) {
                                $id = $resp['.id'];
                                $query = (new Query('/system/scheduler/remove'))
                                    ->equal('.id', $id);

                                $client->query($query)->read();

                                $query = (new Query('/system/scheduler/add'))
                                    ->equal('name', 'deactivate-' . $name)
                                    ->equal('start-date', $date)
                                    ->equal('start-time', $time)
                                    ->equal('on-event', $source);

                                $client->query($query)->read();
                            }
                        } else {
                            $query = (new Query('/system/scheduler/add'))
                                ->equal('name', 'deactivate-' . $name)
                                ->equal('start-date', $date)
                                ->equal('start-time', $time)
                                ->equal('on-event', $source);

                            $client->query($query)->read();
                        }
                    }
                }
                DB::connection('mysql2')->table('payments')
                    ->where('phone', '=', $p)
                    ->update(['checked' => 1]);
            }
        }
    }
}
