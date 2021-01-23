<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class Add extends Controller
{
    public function index()
    {
        return view('forms.add-user');
    }
}
