<?php

namespace App\Http\Controllers\Api; // Ubah namespace menjadi Api

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pengguna;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pemesanan = Pemesanan::all();
        return response()->json($pemesanan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pengguna' => 'required|exists:penggunas,id',
            'id_tiket' => 'required|exists:tikets,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pemesanan = new Pemesanan();
        $pemesanan->id_pengguna = $request->id_pengguna;
        $pemesanan->id_tiket = $request->id_tiket;
        $pemesanan->jumlah = $request->jumlah;
        $pemesanan->tanggal_pemesanan = $request->tanggal_pemesanan;
        $pemesanan->save();

        return response()->json(['message' => 'Pemesanan berhasil ditambahkan', 'data' => $pemesanan], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return response()->json($pemesanan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_pengguna' => 'nullable|exists:penggunas,id',
            'id_tiket' => 'nullable|exists:tikets,id',
            'jumlah' => 'nullable|integer|min:1',
            'tanggal_pemesanan' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pemesanan->id_pengguna = $request->input('id_pengguna', $pemesanan->id_pengguna);
        $pemesanan->id_tiket = $request->input('id_tiket', $pemesanan->id_tiket);
        $pemesanan->jumlah = $request->input('jumlah', $pemesanan->jumlah);
        $pemesanan->tanggal_pemesanan = $request->input('tanggal_pemesanan', $pemesanan->tanggal_pemesanan);
        $pemesanan->save();

        return response()->json(['message' => 'Pemesanan berhasil diupdate', 'data' => $pemesanan], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return response()->json(['message' => 'Pemesanan berhasil dihapus'], 204);
    }
}
