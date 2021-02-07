<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::where('converted', 1)->orderBy('year', 'desc')->limit(20)->latest()->get();

        return view('movies.index', ['movies' => $movies]);
    }

    public function test()
    {
        $movies = Movie::where('converted', 1)->orderBy('year', 'desc')->limit(20)->latest()->get();

        return view('movies.test', ['movies' => $movies]);
    }

    public function playMovie(Request $request)
    {
        $movie = Movie::find($request->movie);

        $name = $movie->name;
        $url = Storage::disk($movie->disk)->url($name . "/playlist.m3u8");
        $poster = Storage::disk($movie->disk)->url($name . "/fanart.jpg");

        $watcher = new Watchers();
        $watcher->name = Auth::user()->username;
        $watcher->movie = $name;
        $watcher->save();

        $request->headers->set('Accept-Ranges', 'bytes | 5000');

        return view('movies.player', ['movie' => $name, 'url' => $url, 'poster' => $poster]);
    }

    public function showPackages()
    {
        return view('movie-packages');
    }

    public function movieInfo(Request $request)
    {
        $movie = $request->movie;

        $movie = Movie::find($movie);

        return view('movies.info', ['movie' => $movie]);
    }
}
