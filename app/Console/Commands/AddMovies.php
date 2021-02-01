<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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
                        print_r($info);
                        if (array_key_exists('mpaa', $info)) {
                            $movie->mpaa = $info['mpaa'];
                        }
                        if (array_key_exists('director', $info)) {
                            if (!is_array($info['director'])) {
                                $movie->director = $info['director'];
                            }
                        }
                        if (array_key_exists('uniqueid', $info)) {
                            if (!is_array($info['uniqueid'])) {
                                foreach ($info['uniqueid'] as $id) {
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://webservice.fanart.tv/v3/movies/$id");
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: 6012ad815ffea10ea5e17f8231576b22', 'client-key: f4f756be630725b39f18509ac8209f9c'));
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    $result = curl_exec($ch);
                                    curl_close($ch);
                                    echo $result;
                                }
                            }
                        }
                        if (array_key_exists('studio', $info)) {
                            if (!is_array($info['studio'])) {
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

        $movies = Storage::disk('movies2')->allDirectories();
        foreach ($movies as $name) {
            // convert movies
            $files = Storage::disk('movies2')->allFiles($name);
            foreach ($files as $file) {
                $file_parts = pathinfo($file);
                if ($file_parts['extension'] == 'mp4') {
                    $directory = $file_parts['dirname'];
                    chdir("/run/media/thetechglitch/MOVIES/$directory");
                    shell_exec("ffmpeg -i $file -codec: copy -b:v 2800k -maxrate 2996k -bufsize 4200k -b:a 128k  -start_number 0 -hls_time 4 -hls_list_size 0 -f hls -hls_playlist_type vod -hls_segment_filename playlist_%03d.ts playlist.m3u8");
                }
            }

            $count = Movie::where('name', $name)->count('id');
            if ($count == 0) {
                $movie = new Movie();
                $movie->name = $name;
                $files = Storage::disk('movies2')->allFiles($name);
                foreach ($files as $file) {
                    $file_parts = pathinfo($file);
                    if ($file_parts['extension'] == 'nfo') {
                        $file = file_get_contents(Storage::disk('movies2')->path($file));

                        $xml = simplexml_load_string($file);

                        $json = json_encode($xml);

                        $info = json_decode($json, TRUE);

                        $description = $info['plot'];
                        $movie->description = $description;
                        $movie->year = $info['year'];
                        $movie->runtime = $info['runtime'];
                        $movie->rating = $info['rating'];
                        print_r($info);
                        if (array_key_exists('mpaa', $info)) {
                            $movie->mpaa = $info['mpaa'];
                        }
                        if (array_key_exists('director', $info)) {
                            if (!is_array($info['director'])) {
                                $movie->director = $info['director'];
                            }
                        }
                        if (array_key_exists('uniqueid', $info)) {
                            if (!is_array($info['uniqueid'])) {
                                foreach ($info['uniqueid'] as $id) {
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://webservice.fanart.tv/v3/movies/$id");
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: 6012ad815ffea10ea5e17f8231576b22', 'client-key: f4f756be630725b39f18509ac8209f9c'));
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    $result = curl_exec($ch);
                                    curl_close($ch);
                                    echo $result;
                                }
                            }
                        }
                        if (array_key_exists('studio', $info)) {
                            if (!is_array($info['studio'])) {
                                $movie->studio = $info['studio'];
                            }
                        }
                        $movie->trailer = $info['trailer'];
                        $movie->disk = 'movies2';
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
                            if (!array_key_exists('thumb', $actors)) {
                                break;
                            }
                            $actor = new Actor();

                            $actor->name = $name;
                            $actor->actor = $res['name'];
                            $actor->thumb = $res['thumb'];
                            $actor->role = $res['role'];
                            $actor->save();

                            $i++;
                        }
                    }
                }
            }
        }
    }
}
