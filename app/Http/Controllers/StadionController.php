<?php

namespace App\Http\Controllers;

use App\Models\Stadion;
use Illuminate\Http\Request;

class StadionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stadion = Stadion::all();
        return view('stadion.index', compact('stadion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stadion = Stadion::all();
        return view('stadion.create', compact('stadion'));
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
            'nama_stadion' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|max:255',
            'jenis_stadion' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $stadion = new Stadion();
        $stadion->nama_stadion = $request->nama_stadion;
        $stadion->lokasi = $request->lokasi;
        $stadion->kapasitas = $request->kapasitas;
        $stadion->jenis_stadion = $request->jenis_stadion;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/stadions', $image->hashName());
        $stadion->image = $image->hashName();
        $stadion->save();
        return redirect()->route('stadion.index');
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
        $stadion = Stadion::findOrFail($id);
        return view('stadion.edit', compact('stadion'));
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
            'nama_stadion' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|max:255',
            'jenis_stadion' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $stadion = Stadion::findOrFail($id);
        $stadion->nama_stadion = $request->nama_stadion;
        $stadion->lokasi = $request->lokasi;
        $stadion->kapasitas = $request->kapasitas;
        $stadion->jenis_stadion = $request->jenis_stadion;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/stadions', $image->hashName());
        $stadion->image = $image->hashName();
        $stadion->save();

        return redirect()->route('stadion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stadion = Stadion::findOrFail($id);
        $stadion->delete();
        return redirect()->route('stadion.index');
    }
}
