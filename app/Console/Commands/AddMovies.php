<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class AddMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find newly downloaded movies and add to database';

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
        $movies = Storage::disk('movies')->allDirectories();
        foreach ($movies as $name) {
            $count = Movie::where('name', $name)->count('id');
            if ($count == 0) {
                $movie = new Movie();
                $movie->name = $name;
                $files = Storage::disk('movies')->allFiles($name);
                foreach ($files as $file) {
                    $file_parts = pathinfo($file);
                    if ($file_parts['extension'] == 'nfo') {
                        $file = file_get_contents(Storage::disk('movies')->path($file));

                        $xml = simplexml_load_string($file);

                        $json = json_encode($xml);

                        $info = json_decode($json, TRUE);

                        $description = $info['plot'];
                        $movie->description = $description;
                        $movie->year = $info['year'];
                        $movie->runtime = $info['runtime'];
                        $movie->rating = $info['rating'];
                        if (array_key_exists('mpaa', $info)) {
                            $movie->mpaa = $info['mpaa'];
                        }
                        if (array_key_exists('director', $info)) {
                            if (!is_array($info['director'])) {
                                $movie->director = $info['director'];
                            }
                        }
                        if (array_key_exists('studio', $info)) {
                            if (!is_array($info['director'])) {
                                $movie->studio = $info['studio'];
                            }
                        }
                        $movie->trailer = $info['trailer'];
                        $movie->save();

                        $genre = $info['genre'];

                        if (is_array($genre)) {
                            foreach ($genre as $res) {
                                $genreM = new Genre();

                                $genreM->name = $name;
                                $genreM->genre = $res;

                                $genreM->save();
                            }
                        }

                        $actors = $info['actor'];
                        $i = 0;
                        foreach ($actors as $res) {
                            $actor = new Actor();

                            $actor->name = $name;
                            $actor->actor = $res['name'];
                            $actor->thumb = $res['thumb'];
                            $actor->role = $res['role'];
                            $actor->save();

                            if (!array_key_exists('thumb', $actors)) {
                                break;
                            }

                            $i++;
                        }
                    }
                }
            }
        }
    }
}
