<?php

namespace App\Http\Controllers;

use App\Models\Volume;
use Illuminate\Http\Request;

class VolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function onVolumeChange(Request $request): string
    {
        $user = $request->user;
        $volume = $request->volume;

        $count = \App\Models\Volume::where('user_id', $user)->count('id');
        if ($count == 0) {
            $volume = new \App\Models\Volume();

            $volume->user_id = $user;
            $volume->volume = $volume;
            $volume->save();
        } else {
            $volume = VolumeController::find($user);
            $volume->volume = $volume;
            $volume->update();
        }

        return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Volume $volume
     * @return \Illuminate\Http\Response
     */
    public function show(Volume $volume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Volume $volume
     * @return \Illuminate\Http\Response
     */
    public function edit(Volume $volume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Volume $volume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volume $volume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Volume $volume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volume $volume)
    {
        //
    }
}
