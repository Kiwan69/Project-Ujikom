<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class AdminPemesananController extends Controller
{
    public function index()
    {
        // Ambil semua pemesanan dengan relasi user & tiket
        $pemesanan = Pemesanan::with(['user', 'tiket'])->latest()->get();

        // Kirim data ke view
        return view('admin.pemesanan.index', compact('pemesanan'));
    }
}
