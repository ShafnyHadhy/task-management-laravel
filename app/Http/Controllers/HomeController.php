<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.adminhome');
    }

    public function userDashboard()
    {
        return view('dashboard');
    }
}
