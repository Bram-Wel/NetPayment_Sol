<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Query;

class CheckScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check scheduler and remind user if less than a day left.';

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
     * @throws ConfigException
     */
    public function handle()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT')
        ]);

        $client = new Client($config);

        $query = (new Query('/system/scheduler/print'));
        $response = $client->query($query)->read();
        foreach ($response as $res) {
            $date = $res['start-date'];
            $time = $res['start-time'];

            $end = $date . " " . $time;

        }
    }
}
