<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class editUser extends Controller
{
    public function index($name)
    {
        return view('users.edit', ['username' => $name]);
    }
}
