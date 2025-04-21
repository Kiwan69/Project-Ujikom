<?php

namespace App\Http\Controllers\Api; // Ubah namespace menjadi Api

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return response()->json($pembayaran);
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
            'id_pemesanan' => 'required|exists:pemesanans,id',
            'metode_pembayaran' => 'required|string|max:255',
            'status_pembayaran' => 'required|string|max:255',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_bayar' => 'required|numeric', // Ubah validasi menjadi numeric
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pembayaran = new Pembayaran();
        $pembayaran->id_pemesanan = $request->id_pemesanan;
        $pembayaran->metode_pembayaran = $request->metode_pembayaran;
        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->jumlah_bayar = $request->jumlah_bayar;
        $pembayaran->save();

        return response()->json(['message' => 'Pembayaran berhasil ditambahkan', 'data' => $pembayaran], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return response()->json($pembayaran);
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
        $pembayaran = Pembayaran::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_pemesanan' => 'nullable|exists:pemesanans,id',
            'metode_pembayaran' => 'nullable|string|max:255',
            'status_pembayaran' => 'nullable|string|max:255',
            'tanggal_pembayaran' => 'nullable|date',
            'jumlah_bayar' => 'nullable|numeric', // Ubah validasi menjadi numeric
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pembayaran->id_pemesanan = $request->input('id_pemesanan', $pembayaran->id_pemesanan);
        $pembayaran->metode_pembayaran = $request->input('metode_pembayaran', $pembayaran->metode_pembayaran);
        $pembayaran->status_pembayaran = $request->input('status_pembayaran', $pembayaran->status_pembayaran);
        $pembayaran->tanggal_pembayaran = $request->input('tanggal_pembayaran', $pembayaran->tanggal_pembayaran);
        $pembayaran->jumlah_bayar = $request->input('jumlah_bayar', $pembayaran->jumlah_bayar);
        $pembayaran->save();

        return response()->json(['message' => 'Pembayaran berhasil diupdate', 'data' => $pembayaran], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return response()->json(['message' => 'Pembayaran berhasil dihapus'], 204);
    }
}
