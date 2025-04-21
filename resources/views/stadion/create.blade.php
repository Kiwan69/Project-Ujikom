@extends('layouts.backend.admin')

@section('halaman')Stadion @endsection
@section('judul')Stadion @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Stadion</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('stadion.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_stadion" class="form-label">{{ __('Nama Stadion') }}</label>
                    <input type="text" class="form-control @error('nama_stadion') is-invalid @enderror" name="nama_stadion" id="nama_stadion"
                        value="{{ old('nama_stadion') }}" placeholder="Nama stadion">
                    @error('nama_stadion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">{{ __('Lokasi') }}</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi"
                        value="{{ old('lokasi') }}" placeholder="Lokasi">
                    @error('lokasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">{{ __('Kapasitas') }}</label>
                    <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" name="kapasitas" id="kapasitas"
                        value="{{ old('kapasitas') }}" placeholder="Kapasitas">
                    @error('kapasitas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis_stadion" class="form-label">{{ __('Jenis Stadion') }}</label>
                    <input type="text" class="form-control @error('jenis_stadion') is-invalid @enderror" name="jenis_stadion" id="jenis_stadion"
                        value="{{ old('jenis_stadion') }}" placeholder="Jenis Stadion">
                    @error('jenis_stadion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        value="{{ old('image') }}" required></input>
                    @error('image')
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
