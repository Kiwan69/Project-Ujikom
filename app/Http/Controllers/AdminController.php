<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('layouts.backend.admin'); // kita akan buat view-nya nanti
    }
}
