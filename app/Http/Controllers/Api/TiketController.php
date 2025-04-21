<?php

namespace App\Http\Controllers\Api; // Ubah namespace menjadi Api

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tiket = Tiket::all();
        return response()->json($tiket);
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
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|between:0,99999999.99',
            'kategori' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'id_acara' => 'required|exists:acaras,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tiket = new Tiket();
        $tiket->stok = $request->stok;
        $tiket->harga = $request->harga;
        $tiket->kategori = $request->kategori;
        $tiket->status = $request->status;
        $tiket->id_acara = $request->id_acara;
        $tiket->save();

        return response()->json(['message' => 'Tiket berhasil ditambahkan', 'data' => $tiket], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tiket = Tiket::findOrFail($id);
        return response()->json($tiket);
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
        $tiket = Tiket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'stok' => 'nullable|integer|min:0',
            'harga' => 'nullable|numeric|between:0,99999999.99',
            'kategori' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'id_acara' => 'nullable|exists:acaras,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tiket->stok = $request->input('stok', $tiket->stok);
        $tiket->harga = $request->input('harga', $tiket->harga);
        $tiket->kategori = $request->input('kategori', $tiket->kategori);
        $tiket->status = $request->input('status', $tiket->status);
        $tiket->id_acara = $request->input('id_acara', $tiket->id_acara);
        $tiket->save();

        return response()->json(['message' => 'Tiket berhasil diupdate', 'data' => $tiket], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->delete();

        return response()->json(['message' => 'Tiket berhasil dihapus'], 204);
    }

    public function tampilkanTiket()
    {
        $kategori = request('kategori');

        $query = Tiket::with(['acara.stadion'])->where('status', 'Tersedia');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $tiket = $query->get();

        return view('tiket', compact('tiket'));
    }

    public function beli($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('tiket.beli', compact('tiket'));
    }
}
