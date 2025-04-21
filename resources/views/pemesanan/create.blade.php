@extends('layouts.backend.admin')

@section('halaman')Pemesanan @endsection
@section('judul')Pemesanan @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Pemesanan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pemesanan.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Pengguna') }}</label>
                    <select name="id_pengguna" class="form-select">
                        <option></option>
                        @forelse ($pengguna as $data)
                            <option value="{{ $data->id }}" @error('id_pengguna') is-invalid @enderror>
                                {{ $data->nama }}</option>
                        @empty
                            <option value="" disabled>Pengguna belum tersedia</option>
                        @endforelse
                    </select>

                    @error('id_pengguna')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Tiket') }}</label>
                    <select name="id_tiket" class="form-select">
                        <option></option>
                        @forelse ($tiket as $data)
                            <option value="{{ $data->id }}" @error('id_tiket') is-invalid @enderror>
                                {{ $data->kategori }}</option>
                        @empty
                            <option value="" disabled>Tiket belum tersedia</option>
                        @endforelse
                    </select>

                    @error('id_tiket')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">{{ __('jumlah') }}</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                        id="jumlah" value="{{ old('jumlah') }}" placeholder="jumlah">
                    @error('jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_pemesanan" class="form-label">{{ __('Tanggal & Waktu Pemesanan') }}</label>
                    <input type="datetime-local"
                           class="form-control @error('tanggal_pemesanan') is-invalid @enderror"
                           name="tanggal_pemesanan"
                           id="tanggal_pemesanan"
                           value="{{ old('tanggal_pemesanan') }}"
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
@endsection
