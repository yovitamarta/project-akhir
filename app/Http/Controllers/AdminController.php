<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/admindashboard'); // cari file di resources/views/admin/admindashboard.blade.php
    }
    public function manageUsers()
    {
        return view('admin.users'); 
    }

    public function settings()
    {
        return view('admin.settings');
    }

}


