<?php

namespace App\Http\Controllers;

class EditProfile extends Controller
{
    public function index($name)
    {
        return view('profiles.edit', ['profile' => $name]);
    }
}
