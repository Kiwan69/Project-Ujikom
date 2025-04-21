@extends('layouts.backend.admin')

@section('halaman')Pemesanan @endsection
@section('judul')Pemesanan @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Pemesanan</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('pemesanan.update', $pemesanan->id) }}">
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Pengguna') }}</label>
                    <select class="form-select @error('id_pengguna') is-invalid @enderror" name="id_pengguna" required>
                        <option value="">Pilih Pengguna</option>
                        @foreach ($penggunaOptions as $pengguna)
                            <option value="{{ $pengguna->id }}"
                                {{ $pemesanan->id_pengguna == $pengguna->id ? 'selected' : '' }}>
                                {{ $pengguna->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pengguna')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Tiket') }}</label>
                    <select class="form-select @error('id_tiket') is-invalid @enderror" name="id_tiket" required>
                        <option value="">Pilih Tiket</option>
                        @foreach ($tiketOptions as $tiket)
                            <option value="{{ $tiket->id }}" {{ $pemesanan->id_tiket == $tiket->id ? 'selected' : '' }}>
                                {{ $tiket->kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_tiket')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">{{ __('Jumlah') }}</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                        id="jumlah" value="{{ $pemesanan->jumlah }}" placeholder="Jumlah">

                    @error('jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_pemesanan" class="form-label">{{ __('Tanggal & Waktu Pemesanan') }}</label>
                    <input type="datetime-local" class="form-control @error('tanggal_pemesanan') is-invalid @enderror"
                        name="tanggal_pemesanan" id="tanggal_pemesanan" value="{{ $pemesanan->tanggal_pemesanan }}"
                        placeholder="Pilih Tanggal & Waktu Pemesanan">
                    @error('tanggal_pemesanan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>
@endsection
