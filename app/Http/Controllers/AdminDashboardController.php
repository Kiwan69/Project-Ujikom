<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('layouts.backend.admin'); // kita akan buat view-nya nanti
    }
}
