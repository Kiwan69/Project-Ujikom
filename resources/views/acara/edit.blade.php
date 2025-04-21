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
            <h5 class="card-title mb-0">Edit Pertandingan</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('acara.update', $acara->id) }}">
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <label for="nama_pertandingan" class="form-label">{{ __('Nama Pertandingan') }}</label>
                    <input type="text" class="form-control @error('nama_pertandingan') is-invalid @enderror"
                        name="nama_pertandingan" id="nama_pertandingan" value="{{ $acara->nama_pertandingan }}"
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
                        id="tanggal" value="{{ $acara->tanggal }}" placeholder="Tanggal">

                    @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="waktu_mulai" class="form-label">{{ __('Waktu Mulai') }}</label>
                    <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai"
                        id="waktu_mulai" value="{{ $acara->waktu_mulai }}" placeholder="Waktu Mulai">
                    @error('waktu_mulai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="waktu_selesai" class="form-label">{{ __('Waktu Selesai') }}</label>
                    <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror"
                        name="waktu_selesai" id="waktu_selesai" value="{{ $acara->waktu_selesai }}"
                        placeholder="Waktu Selesai">
                    @error('waktu_selesai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Stadion') }}</label>
                    <select class="form-select @error('id_stadion') is-invalid @enderror" name="id_stadion" required>
                        <option value="">Pilih Stadion</option>
                        @foreach ($stadionOptions as $stadion)
                            <option value="{{ $stadion->id }}"
                                {{ $acara->id_stadion == $stadion->id ? 'selected' : '' }}>
                                {{ $stadion->nama_stadion }}
                            </option>
                        @endforeach
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
                        value="{{ $acara->image }}"></input>
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
    </div>
@endsection
