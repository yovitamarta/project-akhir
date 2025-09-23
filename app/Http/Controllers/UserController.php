<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function settings()
    {
        return view('user.settings');
    }
}
