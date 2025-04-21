@extends('layouts.backend.admin')

@section('halaman')Tiket @endsection
@section('judul')Tiket @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Tiket</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('tiket.update', $tiket->id) }}">
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <label for="stok" class="form-label">{{ __('Stok') }}</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok"
                        value="{{ $tiket->jumlah }}" placeholder="Stok">
                    @error('stok')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">{{ __('Harga') }}</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                        id="harga" value="{{ $tiket->harga }}" placeholder="Harga" step="0.01" min="0">
                    @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">{{ __('Kategori') }}</label>
                    <select class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="VIP" {{ $tiket->kategori == 'VIP' ? 'selected' : '' }}>VIP</option>
                        <option value="Reguler" {{ $tiket->kategori == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="Ekonomi" {{ $tiket->kategori == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                    </select>

                    @error('kategori')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                                <div class="mb-3">
                    <label for="status" class="form-label">{{ __('Status') }}</label>
                    <input type="text" class="form-control @error('status') is-invalid @enderror" name="status"
                        id="status" value="{{ $tiket->status }}" placeholder="Status">

                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Pertandingan') }}</label>
                    <select class="form-select @error('id_acara') is-invalid @enderror" name="id_acara" required>
                        <option value="">Pilih Pertandingan</option>
                        @foreach ($acaraOptions as $acara)
                            <option value="{{ $acara->id }}"
                                {{ $acara->id_acara == $acara->id ? 'selected' : '' }}>
                                {{ $acara->nama_pertandingan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_acara')
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
