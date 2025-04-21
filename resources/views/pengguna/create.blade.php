@extends('layouts.backend.admin')

@section('halaman')Pengguna @endsection
@section('judul')Pengguna @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Pengguna</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pengguna.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">{{ __('Nama') }}</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                        value="{{ old('nama') }}" placeholder="Nama">
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                        value="{{ old('email') }}" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">{{ __('Telepon') }}</label>
                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" id="telepon"
                        value="{{ old('telepon') }}" placeholder="Telepon">
                    @error('telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                        value="{{ old('alamat') }}" placeholder="Alamat">
                    @error('alamat')
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
