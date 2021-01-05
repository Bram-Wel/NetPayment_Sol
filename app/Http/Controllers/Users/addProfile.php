<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class addProfile extends Controller
{
    public function index()
    {
        return view('forms.add-profile');
    }
}
