<?php

namespace App\Http\Controllers\Api; // Ubah namespace menjadi Api

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Stadion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $acara = Acara::all();
        return response()->json($acara);
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
            'nama_pertandingan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'id_stadion' => 'required|exists:stadions,id',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $acara = new Acara();
        $acara->nama_pertandingan = $request->nama_pertandingan;
        $acara->tanggal = $request->tanggal;
        $acara->waktu_mulai = $request->waktu_mulai;
        $acara->waktu_selesai = $request->waktu_selesai;
        $acara->id_stadion = $request->id_stadion;

        // Upload image
        $image = $request->file('image');
        $path = $image->storeAs('public/acaras', $image->hashName());
        $acara->image = $image->hashName();
        $acara->save();

        return response()->json(['message' => 'Acara berhasil ditambahkan', 'data' => $acara], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $acara = Acara::findOrFail($id);
        return response()->json($acara);
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
        $acara = Acara::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_pertandingan' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'id_stadion' => 'nullable|exists:stadions,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $acara->nama_pertandingan = $request->input('nama_pertandingan', $acara->nama_pertandingan);
        $acara->tanggal = $request->input('tanggal', $acara->tanggal);
        $acara->waktu_mulai = $request->input('waktu_mulai', $acara->waktu_mulai);
        $acara->waktu_selesai = $request->input('waktu_selesai', $acara->waktu_selesai);
        $acara->id_stadion = $request->input('id_stadion', $acara->id_stadion);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::delete('public/acaras/' . $acara->image);

            // Upload gambar baru
            $image = $request->file('image');
            $path = $image->storeAs('public/acaras', $image->hashName());
            $acara->image = $image->hashName();
        }

        $acara->save();

        return response()->json(['message' => 'Acara berhasil diupdate', 'data' => $acara], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $acara = Acara::findOrFail($id);

        // Hapus gambar terkait
        Storage::delete('public/acaras/' . $acara->image);

        $acara->delete();

        return response()->json(['message' => 'Acara berhasil dihapus'], 204);
    }
}
