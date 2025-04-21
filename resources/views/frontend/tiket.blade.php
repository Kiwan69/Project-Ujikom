@extends('layouts.frontend.user')

@section('content')
    <section class="ticket-section py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase">Pesan Tiket Anda</h2>
                <p class="text-muted">Dapatkan pengalaman terbaik dengan memesan tiket pilihan Anda!</p>
                @if (request()->has('kategori'))
                    <h5 class="text-primary">
                        Menampilkan Tiket Kategori: <strong>{{ request('kategori') }}</strong>
                    </h5>
                @endif
            </div>
            <div class="row g-4">
                @forelse($tiket as $data)
                    <div class="col-md-6 col-lg-3"> <!-- Lebar 4 kartu dalam 1 baris -->
                        <div class="card border-0 shadow-sm text-center">

                            <!-- Gambar Tiket -->
                            <img src="{{ asset('storage/public/acaras/' . $data->acara->image) }}" class="card-img-top"
                                alt="Gambar Tiket">

                            <div class="card-body">
                                <!-- Tribun (Nama Sesuai Warna) -->
                                <p class="fw-bold">
                                    Tiket:
                                    <span
                                        class="text-{{ $data->kategori == 'VIP' ? 'danger' : ($data->kategori == 'Regulet' ? 'primary' : ($data->kategori == 'Ekonomi' ? 'warning' : 'dark')) }}">
                                        {{ $data->kategori }}
                                    </span>
                                </p>

                                <!-- Harga -->
                                <p class="text-success fw-bold">Harga: Rp{{ number_format($data->harga, 0, ',', '.') }}</p>

                                <!-- Nama Pertandingan -->
                                <h6 class="fw-bold">{{ strtoupper($data->acara->nama_pertandingan) }}</h6>

                                <!-- Tanggal dan Lokasi -->
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ \Carbon\Carbon::parse($data->acara->tanggal)->format('d M Y') }} |
                                    <i class="bi bi-clock"></i> {{ date('H:i', strtotime($data->acara->waktu_mulai)) }}
                                </p>
                                <p class="text-muted small">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    {{ $data->acara->stadion->nama_stadion }}
                                </p>

                                <!-- Tombol Beli Tiket -->
                                @if ($data->status == 'Tersedia')
                                <a href="{{ route('tiket.beli', $data->id) }}" class="btn btn-primary">Beli Tiket</a>
                                @else
                                    <button class="btn btn-danger w-100" disabled>Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h5 class="text-muted">Tiket dengan kategori tersebut belum tersedia.</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
