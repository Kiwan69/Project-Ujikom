@extends('layouts.backend.admin')

@section('halaman')
    Acara
@endsection
@section('judul')
    Acara
@endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Pertandingan</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('acara.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_pertandingan" class="form-label">{{ __('Nama Pertandingan') }}</label>
                    <input type="text" class="form-control @error('nama_pertandingan') is-invalid @enderror"
                        name="nama_pertandingan" id="nama_pertandingan" value="{{ old('nama_pertandingan') }}"
                        placeholder="Nama Pertandingan">
                    @error('nama_pertandingan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">{{ __('Tanggal') }}</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                        id="tanggal" value="{{ old('tanggal') }}" placeholder="Tanggal">

                    @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="waktu_mulai" class="form-label">{{ __('Waktu Mulai') }}</label>
                    <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai"
                        id="waktu_mulai" value="{{ old('waktu_mulai') }}" placeholder="Waktu Mulai">
                    @error('waktu_mulai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="waktu_selesai" class="form-label">{{ __('Waktu Selesai') }}</label>
                    <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror"
                        name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai') }}"
                        placeholder="Waktu Selesai">
                    @error('waktu_selesai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Stadion') }}</label>
                    <select name="id_stadion" class="form-select">
                        <option></option>
                        @forelse ($stadion as $data)
                            <option value="{{ $data->id }}" @error('id_stadion') is-invalid @enderror>
                                {{ $data->nama_stadion }}</option>
                        @empty
                            <option value="" disabled>Stadion belum tersedia</option>
                        @endforelse
                    </select>

                    @error('id_stadion')
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
