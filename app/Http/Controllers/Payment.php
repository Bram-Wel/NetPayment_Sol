<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Payment extends Controller
{
    public function index()
    {
        $payments = DB::table('payments')->orderBy('id', 'desc')->paginate(15);
        return view('payments', ['payments' => $payments]);
    }
}
