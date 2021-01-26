<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ShowPackages()
    {
        $result = DB::table('pppoe_packages')
            ->orderBy('time')
            ->paginate();

        return view('packages', ['packages' => $result]);
    }

    public function ShowHotspotPackages()
    {
        $result = DB::table('packages')
            ->orderBy('time')
            ->get();

        return view('packages.hotspot', ['packages' => $result]);
    }

    public function AddPPPOEPackage()
    {
        return view('packages.pppoe.add');
    }

    public function EditPPPOEPackage($id)
    {
        return view('packages.pppoe.edit', ['packageId' => $id]);
    }

    public function AddHotspotPackage()
    {
        return view('packages.hotspot.add');
    }

    public function deletePPPOEPackage($id)
    {
        DB::table('pppoe_packages')
            ->delete([$id]);

        return redirect(route('packages'));
    }

    public function EditHotspotPackage($id)
    {
        return view('packages.hotspot.edit', ['packageId' => $id]);
    }

    public function DeleteHotspotPackage($id)
    {
        DB::table('packages')
            ->delete([$id]);

        return redirect(route('hotspot-packages'));
    }

    public function HotspotActive()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);

        $client = new Client($config);

        $query = (new Query('/ip/hotspot/active/print'));
        $users = $client->q($query)->read();

        return view('hotspot.active', ['users' => $users]);
    }
}

