<?php

namespace App\Http\Controllers\Api; // Ubah namespace menjadi Api

use App\Http\Controllers\Controller;
use App\Models\Stadion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StadionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $stadion = Stadion::all();
        return response()->json($stadion);
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
            'nama_stadion' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|max:255',
            'jenis_stadion' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $stadion = new Stadion();
        $stadion->nama_stadion = $request->nama_stadion;
        $stadion->lokasi = $request->lokasi;
        $stadion->kapasitas = $request->kapasitas;
        $stadion->jenis_stadion = $request->jenis_stadion;

        // Upload image
        $image = $request->file('image');
        $path = $image->storeAs('public/stadions', $image->hashName());
        $stadion->image = $image->hashName();
        $stadion->save();

        return response()->json(['message' => 'Stadion berhasil ditambahkan', 'data' => $stadion], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $stadion = Stadion::findOrFail($id);
        return response()->json($stadion);
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

        $stadion = Stadion::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_stadion' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'kapasitas' => 'nullable|max:255',
            'jenis_stadion' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $stadion->nama_stadion = $request->input('nama_stadion', $stadion->nama_stadion);
        $stadion->lokasi = $request->input('lokasi', $stadion->lokasi);
        $stadion->kapasitas = $request->input('kapasitas', $stadion->kapasitas);
        $stadion->jenis_stadion = $request->input('jenis_stadion', $stadion->jenis_stadion);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::delete('public/stadions/' . $stadion->image);

            // Upload gambar baru
            $image = $request->file('image');
            $path = $image->storeAs('public/stadions', $image->hashName());
            $stadion->image = $image->hashName();
        }

        $stadion->save();

        return response()->json(['message' => 'Stadion berhasil diupdate', 'data' => $stadion], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $stadion = Stadion::findOrFail($id);

        // Hapus gambar terkait
        Storage::delete('public/stadions/' . $stadion->image);

        $stadion->delete();

        return response()->json(['message' => 'Stadion berhasil dihapus'], 204);
    }
}
