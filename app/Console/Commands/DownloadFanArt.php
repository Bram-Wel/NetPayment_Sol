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
        foreach ($movies as $name) {
            $files = Storage::disk('movies2')->allFiles($name);
            foreach ($files as $file) {
                $file_parts = pathinfo($file);
                if ($file_parts['extension'] == 'nfo') {
                    $file = file_get_contents(Storage::disk('movies2')->path($file));
                    $xml = simplexml_load_string($file);
                    $json = json_encode($xml);
                    $info = json_decode($json, TRUE);
                    if (array_key_exists('uniqueid', $info)) {
                        if (is_array($info['uniqueid'])) {
                            foreach ($info['uniqueid'] as $id) {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://webservice.fanart.tv/v3/movies/$id");
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: 6012ad815ffea10ea5e17f8231576b22', 'client-key: f4f756be630725b39f18509ac8209f9c'));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $result = curl_exec($ch);
                                $json = json_decode($result, TRUE);
                                curl_close($ch);
                                if (array_key_exists('hdmovielogo', $json)) {
                                    if (is_array($json['hdmovielogo'])) {
                                        foreach ($json['hdmovielogo'] as $logo) {
                                            if ($logo['lang'] == 'en') {
                                                $url = $logo['url'];
                                                $ch = curl_init($url);
                                                $fp = fopen(Storage::disk('movies2')->path($name) . '/logo.jpg', 'wb');
                                                curl_setopt($ch, CURLOPT_FILE, $fp);
                                                curl_setopt($ch, CURLOPT_HEADER, 0);
                                                curl_exec($ch);
                                                curl_close($ch);
                                                fclose($fp);
                                                break;
                                            }
                                        }
                                    } else {
                                        $url = $json['hdmovielogo'];
                                        $ch = curl_init($url);
                                        $fp = fopen(Storage::disk('movies2')->path($name) . '/logo.jpg', 'wb');
                                        curl_setopt($ch, CURLOPT_FILE, $fp);
                                        curl_setopt($ch, CURLOPT_HEADER, 0);
                                        curl_exec($ch);
                                        curl_close($ch);
                                        fclose($fp);
                                    }
                                }
                                if (array_key_exists('moviethumb', $json)) {
                                    if (is_array($json['moviethumb'])) {
                                        if ($logo['lang'] == 'en') {

                                            foreach ($json['moviethumb'] as $logo) {
                                                $url = $logo['url'];
                                                $ch = curl_init($url);
                                                $fp = fopen(Storage::disk('movies2')->path($name) . '/thumb.jpg', 'wb');
                                                curl_setopt($ch, CURLOPT_FILE, $fp);
                                                curl_setopt($ch, CURLOPT_HEADER, 0);
                                                curl_exec($ch);
                                                curl_close($ch);
                                                fclose($fp);
                                                break;
                                            }
                                        }
                                    } else {
                                        $url = $json['moviethumb'];
                                        $ch = curl_init($url);
                                        $fp = fopen(Storage::disk('movies2')->path($name) . '/thumb.jpg', 'wb');
                                        curl_setopt($ch, CURLOPT_FILE, $fp);
                                        curl_setopt($ch, CURLOPT_HEADER, 0);
                                        curl_exec($ch);
                                        curl_close($ch);
                                        fclose($fp);
                                    }
                                }
                            }
                        } else {
                            $id = $info['uniqueid'];
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://webservice.fanart.tv/v3/movies/$id");
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: 6012ad815ffea10ea5e17f8231576b22', 'client-key: f4f756be630725b39f18509ac8209f9c'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $result = curl_exec($ch);
                            $json = json_decode($result, TRUE);
                            curl_close($ch);
                            if (array_key_exists('hdmovielogo', $json)) {
                                if (is_array($json['hdmovielogo'])) {
                                    foreach ($json['hdmovielogo'] as $logo) {
                                        if ($logo['lang'] == 'en') {

                                            $url = $logo['url'];
                                            $ch = curl_init($url);
                                            $fp = fopen(Storage::disk('movies2')->path($name) . '/logo.jpg', 'wb');
                                            curl_setopt($ch, CURLOPT_FILE, $fp);
                                            curl_setopt($ch, CURLOPT_HEADER, 0);
                                            curl_exec($ch);
                                            curl_close($ch);
                                            fclose($fp);
                                            break;
                                        }
                                    }
                                } else {
                                    $url = $json['hdmovielogo'];
                                    $ch = curl_init($url);
                                    $fp = fopen(Storage::disk('movies2')->path($name) . '/logo.jpg', 'wb');
                                    curl_setopt($ch, CURLOPT_FILE, $fp);
                                    curl_setopt($ch, CURLOPT_HEADER, 0);
                                    curl_exec($ch);
                                    curl_close($ch);
                                    fclose($fp);
                                }
                                if (array_key_exists('moviethumb', $json)) {
                                    if (is_array($json['moviethumb'])) {
                                        foreach ($json['moviethumb'] as $logo) {
                                            if ($logo['lang'] == 'en') {

                                                $url = $logo['url'];
                                                $ch = curl_init($url);
                                                $fp = fopen(Storage::disk('movies2')->path($name) . '/thumb.jpg', 'wb');
                                                curl_setopt($ch, CURLOPT_FILE, $fp);
                                                curl_setopt($ch, CURLOPT_HEADER, 0);
                                                curl_exec($ch);
                                                curl_close($ch);
                                                fclose($fp);
                                                break;
                                            }
                                        }
                                    } else {
                                        $url = $json['moviethumb'];
                                        $ch = curl_init($url);
                                        $fp = fopen(Storage::disk('movies2')->path($name) . '/thumb.jpg', 'wb');
                                        curl_setopt($ch, CURLOPT_FILE, $fp);
                                        curl_setopt($ch, CURLOPT_HEADER, 0);
                                        curl_exec($ch);
                                        curl_close($ch);
                                        fclose($fp);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
