<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{
    public function index() {
        if (Auth::user()->admin == 1) {
            $totalUsers = DB::table('users')->count();
            $newUsers = DB::table('users')->whereMonth('created_at', date('m'))->count();

            return view('admin', ['totalUsers' => $totalUsers, 'newUsers' => $newUsers]);
        } else {
            return view('dashboard');
        }
    }
}
