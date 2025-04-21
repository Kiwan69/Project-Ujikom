<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Tiket;
use App\Models\Stadion;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acara = Acara::all();
        return view('acara.index', compact('acara'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stadion = Stadion::all();
        return view('acara.create', compact('stadion'));
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
            'nama_pertandingan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'id_stadion' => 'required|exists:stadions,id',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $acara = new Acara();
        $acara->nama_pertandingan = $request->nama_pertandingan;
        $acara->tanggal = $request->tanggal;
        $acara->waktu_mulai = $request->waktu_mulai;
        $acara->waktu_selesai = $request->waktu_selesai;
        $acara->id_stadion = $request->id_stadion;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/acaras', $image->hashName());
        $acara->image = $image->hashName();
        $acara->save();
        return redirect()->route('acara.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acara = Acara::findOrFail($id);
        return view('acara.show', compact('acara'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acara = Acara::findOrFail($id);
        $stadionOptions = Stadion::all();
        return view('acara.edit', compact('acara', 'stadionOptions'));
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
            'nama_pertandingan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'id_stadion' => 'required|exists:stadions,id',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $acara = Acara::findOrFail($id);
        $acara->nama_pertandingan = $request->nama_pertandingan;
        $acara->tanggal = $request->tanggal;
        $acara->waktu_mulai = $request->waktu_mulai;
        $acara->waktu_selesai = $request->waktu_selesai;
        $acara->id_stadion = $request->id_stadion;
        $image = $request->file('image');
        $image->storeAs('public/acaras', $image->hashName());
        $acara->image = $image->hashName();
        $acara->save();

        return redirect()->route('acara.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acara = Acara::findOrFail($id);
        $acara->delete();
        return redirect()->route('acara.index');
    }
}
