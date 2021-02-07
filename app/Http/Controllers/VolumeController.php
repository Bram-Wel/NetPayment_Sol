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
        $vol = $request->volume;

        $count = \App\Models\Volume::where('user_id', $user)->count('id');
        if ($count == 0) {
            $userVol = new \App\Models\Volume();

            $userVol->user_id = $user;
            $userVol->volume = $vol;
            $userVol->save();
        } else {
            $id = Volume::where('user_id', $user)->value('id');
            $userVol = Volume::find($id);
            $userVol->volume = $vol;
            $userVol->update();
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
