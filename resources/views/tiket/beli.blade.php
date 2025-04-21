@extends('layouts.frontend.user')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Pembelian Tiket</h2>

        <div class="mb-4 border rounded-lg p-4 bg-gray-50">
            <p class="text-sm text-gray-500">Kategori Tiket</p>
            <p class="text-lg font-semibold text-gray-700">{{ $tiket->kategori }}</p>

            <p class="text-sm text-gray-500 mt-2">Harga</p>
            <p class="text-green-600 font-bold text-lg">Rp{{ number_format($tiket->harga, 0, ',', '.') }}</p>

            <p class="text-sm text-gray-500 mt-2">Stok Tersedia</p>
            <p class="text-gray-700">{{ $tiket->stok }}</p>
        </div>

        <form action="{{ route('tiket.konfirmasi') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="tiket_id" value="{{ $tiket->id }}">

            <div>
                <label class="block text-gray-700 text-sm mb-1">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Jumlah Tiket</label>
                <input type="number" name="jumlah" min="1" max="{{ $tiket->stok }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400" required>
            </div>

            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('tiket.index') }}" class="text-blue-600 hover:underline text-sm">← Kembali</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all">Konfirmasi Pembelian</button>
            </div>
        </form>
    </div>
</div>
@endsection
