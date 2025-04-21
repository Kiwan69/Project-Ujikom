<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemesanan = Pemesanan::all();
        return view('pembayaran.create', compact('pemesanan'));
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
            'id_pemesanan' => 'required|exists:pemesanans,id',
            'metode_pembayaran' => 'required|string|max:255',
            'status_pembayaran' => 'required|string|max:255',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_bayar' => 'required|max:255',
        ]);

        $pembayaran = new Pembayaran();
        $pembayaran->id_pemesanan = $request->id_pemesanan;
        $pembayaran->metode_pembayaran = $request->metode_pembayaran;
        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->jumlah_bayar = $request->jumlah_bayar;
        $pembayaran->save();
        return redirect()->route('pembayaran.index');
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
        $pembayaran = Pembayaran::findOrFail($id);
        $pemesananOptions = Pemesanan::all();
        return view('pembayaran.edit', compact('pembayaran', 'pemesananOptions'));
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
            'id_pemesanan' => 'required|exists:pemesanans,id',
            'metode_pembayaran' => 'required|string|max:255',
            'status_pembayaran' => 'required|string|max:255',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_bayar' => 'required|max:255',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->id_pemesanan = $request->id_pemesanan;
        $pembayaran->metode_pembayaran = $request->metode_pembayaran;
        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->jumlah_bayar = $request->jumlah_bayar;
        $pembayaran->save();
        return redirect()->route('pembayaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect()->route('pembayaran.index');
    }
}
