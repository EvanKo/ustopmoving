<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $name = $request->get('name');
        $password = bcrypt($request->get('password'));
        Auth::
    }
}
