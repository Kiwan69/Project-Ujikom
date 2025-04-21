@extends('layouts.backend.admin')

@section('halaman')Pembayaran @endsection
@section('judul')Pembayaran @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Pembayaran</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pembayaran.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Pemesanan') }}</label>
                    <select name="id_pemesanan" class="form-select">
                        <option></option>
                        @forelse ($pemesanan as $data)
                            <option value="{{ $data->id }}" @error('id_pemesanan') is-invalid @enderror>
                                {{ $data->pengguna->nama}}</option>
                        @empty
                            <option value="" disabled>Pemesanan belum tersedia</option>
                        @endforelse
                    </select>

                    @error('id_pemesanan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label">{{ __('Metode Pembayaran') }}</label>
                    <input type="text" class="form-control @error('metode_pembayaran') is-invalid @enderror"
                        name="metode_pembayaran" id="metode_pembayaran" value="{{ old('metode_pembayaran') }}"
                        placeholder="Metode Pembayaran">
                    @error('metode_pembayaran')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status_pembayaran" class="form-label">{{ __('Status Pembayaran') }}</label>
                    <input type="text" class="form-control @error('status_pembayaran') is-invalid @enderror"
                        name="status_pembayaran" id="status_pembayaran" value="{{ old('status_pembayaran') }}"
                        placeholder="status Pembayaran">
                    @error('status_pembayaran')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_pembayaran" class="form-label">{{ __('Tanggal & Waktu Pembayaran') }}</label>
                    <input type="datetime-local" class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                        name="tanggal_pembayaran" id="tanggal_pembayaran" value="{{ old('tanggal_pembayaran') }}"
                        placeholder="Pilih Tanggal & Waktu pembayaran">
                    @error('tanggal_pembayaran')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jumlah_bayar" class="form-label">{{ __('Jumlah Bayar') }}</label>
                    <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar"
                        id="jumlah_bayar" value="{{ old('jumlah_bayar') }}" placeholder="Jumlah Bayar" step="0.01" min="0">
                    @error('jumlah_bayar')
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
