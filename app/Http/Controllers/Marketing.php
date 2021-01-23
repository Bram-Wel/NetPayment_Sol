<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Marketing extends Controller
{
    public function index() {
        $messages = DB::table('messages')->orderBy('id', 'desc')->paginate();

        return view('marketing', ['messages'=>$messages]);
    }
}
