<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::where('converted', 1)->latest()->get();

        return view('movies.index', ['movies' => $movies]);
    }

    public function playMovie(Request $request)
    {
        $movie = Movie::find($request->movie);

        $name = $movie->name;
        $url = Storage::disk('movies')->url($name . "/playlist.m3u8");
        $poster = Storage::disk('movies')->url($name . "/fanart.jpg");
        return view('movies.player', ['movie' => $name, 'url' => $url, 'poster' => $poster]);
    }

    public function showPackages()
    {
        return view('movie-packages');
    }
}