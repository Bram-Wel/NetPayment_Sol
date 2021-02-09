<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        $movies = Storage::disk('movies2')->allDirectories();
        dd($movies);
        foreach ($movies as $name) {
            $files = Storage::disk('movies2')->allFiles($name);
            foreach ($files as $file) {
                $file_parts = pathinfo($file);
                if ($file_parts['extension'] == 'nfo') {
                    $file = file_get_contents(Storage::disk('movies2')->path($file));
                    $xml = simplexml_load_string($file);
                    $json = json_encode($xml);
                    $info = json_decode($json, TRUE);
                    dd($info);
                    if (array_key_exists('uniqueid', $info)) {
                        dd($info);
                        if (!is_array($info['uniqueid'])) {
                            foreach ($info['uniqueid'] as $id) {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://webservice.fanart.tv/v3/movies/$id");
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: 6012ad815ffea10ea5e17f8231576b22', 'client-key: f4f756be630725b39f18509ac8209f9c'));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                dd($result);
                            }
                        } else {
                            $id = $info['uniqueid'];
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://webservice.fanart.tv/v3/movies/$id");
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: 6012ad815ffea10ea5e17f8231576b22', 'client-key: f4f756be630725b39f18509ac8209f9c'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            dd($result);
                        }
                    }
                }
            }
        }
    }
}
