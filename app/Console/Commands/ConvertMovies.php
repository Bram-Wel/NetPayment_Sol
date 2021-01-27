<?php

namespace App\Console\Commands;

use App\Models\Movie;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert movies to hls mode';

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
        $movies = Movie::where('converted', 0)->get();
        foreach ($movies as $movie) {
            $name = $movie->name;
            $path = Storage::disk('movies')->path("$name/$name.mp4");
            $path2 = Storage::disk('movies')->path("$name");


            $id = Movie::where('name', $name)->value('id');
            $movieM = Movie::find($id);
            $movieM->converted = 1;
//            $movieM->update();
        }
    }
}
