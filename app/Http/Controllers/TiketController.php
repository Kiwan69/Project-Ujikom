<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Acara;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket = Tiket::all();
        return view('tiket.index', compact('tiket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acara = Acara::all();
        return view('tiket.create', compact('acara'));
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
            'stok' => 'required|max:255',
            'harga' => 'required|max:255',
            'kategori' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'id_acara' => 'required|exists:acaras,id',
        ]);

        $tiket = new Tiket();
        $tiket->stok = $request->stok;
        $tiket->harga = $request->harga;
        $tiket->kategori = $request->kategori;
        $tiket->status = $request->status;
        $tiket->id_acara = $request->id_acara;
        $tiket->save();
        return redirect()->route('tiket.index');
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
        $tiket = Tiket::findOrFail($id);
        $acaraOptions = Acara::all();
        return view('tiket.edit', compact('tiket', 'acaraOptions'));
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
            'stok' => 'required|max:255',
            'harga' => 'required|numeric|between:0,99999999.99',
            'kategori' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'id_acara' => 'required|exists:acaras,id',
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->stok = $request->stok;
        $tiket->harga = $request->harga;
        $tiket->kategori = $request->kategori;
        $tiket->status = $request->status;
        $tiket->id_acara = $request->id_acara;
        $tiket->save();
        return redirect()->route('tiket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->delete();
        return redirect()->route('tiket.index');
    }

    public function tampilkanTiket()
    {
        $kategori = request('kategori');

        $query = Tiket::with(['acara.stadion'])->where('status', 'Tersedia');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $tiket = $query->get();

        return view('frontend.tiket', compact('tiket'));
    }

    public function beli($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('tiket.beli', compact('tiket'));
    }

    public function konfirmasi(Request $request)
    {
        // Validasi data
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'jumlah' => 'required|integer|min:1',
            // tambahkan field lain sesuai kebutuhan
        ]);

        // Simpan ke database, kirim email, atau proses lainnya

        return redirect()->route('tiket.index')->with('success', 'Pembelian tiket berhasil!');
    }
}
