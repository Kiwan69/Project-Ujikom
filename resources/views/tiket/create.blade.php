@extends('layouts.backend.admin')

@section('halaman')
    Tiket
@endsection
@section('judul')
    Tiket
@endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Tiket</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tiket.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="stok" class="form-label">{{ __('Stok') }}</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok"
                        id="stok" value="{{ old('stok') }}" placeholder="Stok">
                    @error('stok')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">{{ __('Harga') }}</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                        id="harga" value="{{ old('harga') }}" placeholder="Harga" step="0.01" min="0">
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
                        <option value="VIP" {{ old('kategori') == 'VIP' ? 'selected' : '' }}>VIP</option>
                        <option value="Reguler" {{ old('kategori') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="Ekonomi" {{ old('kategori') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
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
                        id="status" value="{{ old('status') }}" placeholder="Status">
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Pertandingan') }}</label>
                    <select name="id_acara" class="form-select">
                        <option></option>
                        @forelse ($acara as $data)
                            <option value="{{ $data->id }}" @error('id_acara') is-invalid @enderror>
                                {{ $data->nama_pertandingan }}</option>
                        @empty
                            <option value="" disabled>Acara belum tersedia</option>
                        @endforelse
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
@endsection
