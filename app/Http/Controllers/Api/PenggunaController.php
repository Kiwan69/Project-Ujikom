<?php

namespace App\Http\Controllers\Api; // Ubah namespace menjadi Api

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\User; // Asumsi model pengguna Anda adalah User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pengguna = User::all(); // Mengambil semua data pengguna dari database
        return view('pengguna.index', compact('pengguna'));
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
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:penggunas', // Tambahkan validasi email dan unique
            'telepon' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pengguna = new Pengguna();
        $pengguna->nama = $request->nama;
        $pengguna->email = $request->email;
        $pengguna->telepon = $request->telepon;
        $pengguna->alamat = $request->alamat;
        $pengguna->save();

        return response()->json(['message' => 'Pengguna berhasil ditambahkan', 'data' => $pengguna], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return response()->json($pengguna);
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
        $pengguna = Pengguna::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:penggunas,email,' . $id, // Tambahkan validasi email dan unique (ignore current ID)
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pengguna->nama = $request->input('nama', $pengguna->nama);
        $pengguna->email = $request->input('email', $pengguna->email);
        $pengguna->telepon = $request->input('telepon', $pengguna->telepon);
        $pengguna->alamat = $request->input('alamat', $pengguna->alamat);
        $pengguna->save();

        return response()->json(['message' => 'Pengguna berhasil diupdate', 'data' => $pengguna], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
