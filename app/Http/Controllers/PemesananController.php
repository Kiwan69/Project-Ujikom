<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pengguna;
use App\Models\Tiket;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan = Pemesanan::all();
        return view('pemesanan.index', compact('pemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengguna = Pengguna::all();
        $tiket = Tiket::all();
        return view('pemesanan.create', compact('pengguna','tiket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_pengguna' => 'required|exists:penggunas,id',
            'id_tiket' => 'required|exists:tikets,id',
            'jumlah' => 'required|max:255',
            'tanggal_pemesanan' => 'required|date',
        ]);

        $pemesanan = new Pemesanan();
        $pemesanan->id_pengguna = $request->id_pengguna;
        $pemesanan->id_tiket = $request->id_tiket;
        $pemesanan->jumlah = $request->jumlah;
        $pemesanan->tanggal_pemesanan = $request->tanggal_pemesanan;
        $pemesanan->save();
        return redirect()->route('pemesanan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $penggunaOptions = Pengguna::all();
        $tiketOptions = Tiket::all();
        return view('pemesanan.edit', compact('pemesanan', 'penggunaOptions','tiketOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_pengguna' => 'required|exists:penggunas,id',
            'id_tiket' => 'required|exists:tikets,id',
            'jumlah' => 'required|max:255',
            'tanggal_pemesanan' => 'required|date',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->id_pengguna = $request->id_pengguna;
        $pemesanan->id_tiket = $request->id_tiket;
        $pemesanan->jumlah = $request->jumlah;
        $pemesanan->tanggal_pemesanan = $request->tanggal_pemesanan;
        $pemesanan->save();
        return redirect()->route('pemesanan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();
        return redirect()->route('pemesanan.index');
    }
}
