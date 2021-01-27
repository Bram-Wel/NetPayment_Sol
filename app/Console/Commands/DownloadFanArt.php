<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DownloadFanArt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:fanart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download fanart for movies';

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

    }
}
