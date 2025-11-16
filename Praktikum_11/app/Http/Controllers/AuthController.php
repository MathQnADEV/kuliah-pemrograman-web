<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function signin()
    {
        return view('auth.signin');
    }

    public function signup()
    {
        return view('auth.signup');
    }
}
