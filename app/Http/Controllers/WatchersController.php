<?php

namespace App\Http\Controllers;

use App\Models\Watchers;
use Illuminate\Http\Request;

class WatchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveWatcher(Request $request)
    {
        $movieName = $request->movie;
        $duration = $request->duration;
        $username = $request->user;

        $count = Watchers::where('name', $username)->where('movie', $movieName)->count('id');
        if ($count == 0) {
            $watcher = new Watchers();
            $watcher->name = $username;
            $watcher->movie = $movieName;
            $watcher->length = $duration;

            $watcher->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Watchers $watchers
     * @return \Illuminate\Http\Response
     */
    public function show(Watchers $watchers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Watchers $watchers
     * @return \Illuminate\Http\Response
     */
    public function edit(Watchers $watchers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Watchers $watchers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watchers $watchers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Watchers $watchers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watchers $watchers)
    {
        //
    }
}
