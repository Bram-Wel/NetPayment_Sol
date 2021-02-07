<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Trailers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadTrailers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:trailers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download trailers and get a 10s random segment from movie';

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
        $files = Storage::disk('movies2')->directories();
        foreach ($files as $file) {
            $file_parts = pathinfo($file);
            $directory = $file_parts['basename'];
            $directory = "/run/media/thetechglitch/MOVIES/$directory";
            chdir($directory);
            $movie = $file_parts['basename'];
            $trailer = Movie::where('name', $movie)->value('trailer');
            dd($trailer);
            shell_exec("youtube-dl -f best $movie->trailer --output 'trailer.%(ext)s'");
        }
    }
}
