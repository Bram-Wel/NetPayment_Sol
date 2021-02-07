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
        $files = Storage::disk($movie->disk)->directories();
        foreach ($files as $file) {
            $file_parts = pathinfo($file);
            $directory = $file_parts['dirname'];
            $file = escapeshellarg($file);
            if ($movie->disk == 'movies2') {
                $directory = escapeshellarg("/run/media/thetechglitch/MOVIES/$directory");
            } else {
                $directory = "/srv/http/thetechglitch_internet/storage/app/public/movies/$directory";
            }
            print_r($directory);
            chdir($directory);
            shell_exec("youtube-dl -f best $movie->trailer --output 'trailer.%(ext)s'");
        }
        $trailer = new Trailers();
        $trailer->movie = $movie->name;
        $trailer->downloaded = true;

    }
}
