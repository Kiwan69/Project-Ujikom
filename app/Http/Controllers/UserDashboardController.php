<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('frontend.home'); // kita akan buat view-nya nanti
    }
}
