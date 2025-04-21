@extends('layouts.backend.admin')

@section('halaman')
    Detail Pertandingan
@endsection
@section('judul')
    Detail Pertandingan
@endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark">Detail Pertandingan</h4>
                <a href="{{ route('acara.index') }}" class="btn btn-secondary px-4">
                    <i class="mdi mdi-arrow-left-circle me-1"></i> Kembali
                </a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Pertandingan</th>
                                <td>{{ $acara->nama_pertandingan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal</th>
                                <td>
                                    <span class="badge bg-info text-white">
                                        {{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Waktu Mulai</th>
                                <td>{{ \Carbon\Carbon::parse($acara->waktu_mulai)->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Waktu Selesai</th>
                                <td>{{ \Carbon\Carbon::parse($acara->waktu_selesai)->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Stadion</th>
                                <td>{{ $acara->stadion->nama_stadion }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar Pertandingan</label>
                        <div>
                            <img src="{{ asset('/storage/public/acaras/' . $acara->image) }}" class="img-fluid rounded" alt="{{ $acara->nama_pertandingan }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
