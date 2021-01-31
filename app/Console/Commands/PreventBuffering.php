<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class PreventBuffering extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prevent:buffering';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prevent buffering';

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

        $query = (new Query('/queue/simple/move/'))
            ->equal('name', 'MOVIES')
            ->equal('')
    }
}
