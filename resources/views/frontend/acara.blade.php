@extends('layouts.frontend.user')

@section('content')
<section class="py-5" style="background: linear-gradient(to right, #141e30, #243b55); color: white;">
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold text-uppercase">Jadwal Pertandingan</h2>

        <div class="row">
            <div class="col-md-12">
                <div class="row g-3"> <!-- Mengurangi gap antar kartu -->
                    @foreach ($acara as $data)
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 rounded-lg h-100 small-card" style="background: #1c2331; color: white;">
                                <!-- Gambar Acara -->
                                <div class="card-img-top position-relative">
                                    <img src="{{ asset('storage/public/acaras/' . $data->image)}}" class="img-fluid rounded-top" alt="Gambar Acara">
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-1 px-2 py-1 fs-6">{{ $data->kategori }}</span>
                                </div>

                                <div class="card-body p-2"> <!-- Mengurangi padding -->
                                    <h6 class="card-title fw-bold">{{ $data->nama_pertandingan }}</h6> <!-- Ukuran lebih kecil -->
                                    <p class="card-text mb-1">
                                        <i class="bi bi-calendar-event text-light"></i> {{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-clock text-light"></i> {{ date('H:i', strtotime($data->waktu_mulai)) }} - {{ date('H:i', strtotime($data->waktu_selesai)) }}
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-geo-alt-fill text-danger"></i> {{ $data->stadion->nama_stadion }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Ukuran kartu lebih kecil */
    .small-card {
        max-width: 220px; /* Membatasi lebar kartu */
        font-size: 0.9rem; /* Mengecilkan font */
    }

    /* Hover Effect */
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 10px;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 5px 15px rgba(235, 234, 234, 0.15);
    }

    /* Badge Styling */
    .badge {
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 8px;
    }
</style>
@endsection
