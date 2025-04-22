@extends('layouts.frontend.user')

@section('content')
<style>
    body {
        background-color: #f3f4f6;
    }

    .register-card {
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background-color: #ffffff;
    }

    .register-card-header {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        color: #ffffff;
        font-weight: 600;
        text-align: center;
        padding: 1.5rem;
        font-size: 1.5rem;
    }

    .btn-primary {
        background-color: #1e3c72;
        border: none;
        border-radius: 0.5rem;
        padding: 0.6rem 1.5rem;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #16335e;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card register-card">

                {{-- Header --}}
                <div class="register-card-header">
                    Form Pembelian Tiket
                </div>

                {{-- Card Body --}}
                <div class="card-body px-4 py-4">

                    {{-- Info Tiket --}}
                    <div class="mb-4 text-sm text-gray-700">
                        <div class="flex justify-between">
                            <span><strong>Kategori:</strong> {{ $tiket->kategori }}</span>
                        </div>
                        <div class="mt-1">
                            <strong>Harga:</strong> <span class="text-green-600">Rp{{ number_format($tiket->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('tiket.konfirmasi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_tiket" value="{{ $tiket->id }}">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">telepon</label>
                            <input type="number" name="telepon" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Jumlah Tiket</label>
                            <input type="number" name="jumlah" min="1" max="{{ $tiket->stok }}" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary w-100">
                                Konfirmasi Pembelian
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('tiket') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke daftar tiket</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
