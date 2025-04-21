@extends('layouts.frontend.user')
@section('content')
<!-- Header -->
<header class="text-white text-center" style="
    background: url('frontend/assets/img/stadion.jpg') center/cover no-repeat;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;">

    <!-- Overlay -->
    <div style="
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);">
    </div>

    <div class="container px-5 position-relative" style="z-index: 2;">
        <h1 class="display-4 fw-bold">Pesan Tiket Stadion dengan Mudah</h1>
        <p class="fs-5 text-light mb-4">Nikmati pertandingan dan acara favoritmu tanpa ribet</p>
        <div class="d-flex justify-content-center gap-3">
            <a class="btn btn-primary btn-lg px-4" href="{{route('tiket')}}">Beli Tiket</a>
            <a class="btn btn-outline-light btn-lg px-4" href="{{route('acara')}}">Jadwal Pertandingan</a>
        </div>
    </div>
</header>

<!-- Kategori Tiket Section -->
<section class="bg-light py-5">
    <div class="container px-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bolder">Pilih Kategori Tiket</h2>
            <p class="lead fw-light text-muted">Temukan pengalaman terbaik di stadion sesuai dengan pilihan tiketmu!</p>
        </div>
        <div class="row gx-5 justify-content-center">
            <!-- Tiket VIP -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow text-center py-4">
                    <div class="card-body">
                        <i class="bi bi-stars fs-1 text-warning"></i>
                        <h4 class="fw-bold mt-3">VIP</h4>
                        <p class="text-muted">Nikmati pengalaman eksklusif dengan akses premium dan layanan khusus.</p>
                        <a href="{{ route('tiket', ['kategori' => 'VIP']) }}" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <!-- Tiket Reguler -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow text-center py-4">
                    <div class="card-body">
                        <i class="bi bi-person-circle fs-1 text-primary"></i>
                        <h4 class="fw-bold mt-3">Reguler</h4>
                        <p class="text-muted">Dapatkan kursi terbaik dengan harga yang lebih terjangkau.</p>
                        <a href="{{ route('tiket', ['kategori' => 'Reguler']) }}" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <!-- Tiket Ekonomi -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow text-center py-4">
                    <div class="card-body">
                        <i class="bi bi-ticket fs-1 text-success"></i>
                        <h4 class="fw-bold mt-3">Ekonomi</h4>
                        <p class="text-muted">Nikmati pertandingan dengan harga lebih hemat dan tetap seru!</p>
                        <a href="{{ route('tiket', ['kategori' => 'Ekonomi']) }}" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Stadium -->
<section class="bg-light py-5">
    <div class="container px-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bolder">Stadion di Indonesia</h2>
            <p class="lead fw-light text-muted">Jelajahi stadion terbesar dan terbaik di Indonesia!</p>
        </div>
        <div class="row gx-4 gy-4">
            @foreach($stadion as $data)
            <div class="col-md-4">
                <div class="stadium-card">
                    <img src="{{ asset('storage/public/stadions/' . $data->image) }}" alt="{{ $data->nama_stadion }}">
                    <div class="overlay">
                        <h4>{{ $data->nama_stadion }}</h4>
                        <p>{{ $data->lokasi }}</p>
                        <p>Kapasitas: {{ number_format($data->kapasitas) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- Acara -->
    <section class="bg-light py-5">
        <div class="container px-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bolder">Acara di Stadion</h2>
                <p class="lead fw-light text-muted">Temukan berbagai acara seru yang akan datang di stadion favoritmu!
                </p>
            </div>
            <div class="row gx-4 gy-4">
                <!-- Pertandingan Sepak Bola -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="{{ asset('frontend/assets/img/sepakbola.webp') }}" alt="Pertandingan Sepak Bola">
                        <div class="overlay">
                            <h4>Pertandingan Sepak Bola</h4>
                            <p>Rasakan atmosfer pertandingan seru antara tim favoritmu di stadion terbesar.</p>
                        </div>
                    </div>
                </div>
                <!-- Konser Musik -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="{{ asset('frontend/assets/img/konser.jpeg') }}" alt="Konser Musik">
                        <div class="overlay">
                            <h4>Konser Musik</h4>
                            <p>Nikmati konser dari musisi ternama dengan pengalaman spektakuler di stadion.</p>
                        </div>
                    </div>
                </div>
                <!-- Acara Olahraga Lainnya -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="{{ asset('frontend/assets/img/olahraga.jpg') }}" alt="Acara Olahraga">
                        <div class="overlay">
                            <h4>Acara Olahraga</h4>
                            <p>Dari atletik hingga motorsport, saksikan berbagai acara olahraga seru.</p>
                        </div>
                    </div>
                </div>
                <!-- Festival & Expo -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="{{ asset('frontend/assets/img/expo.webp') }}" alt="Festival & Expo">
                        <div class="overlay">
                            <h4>Festival & Expo</h4>
                            <p>Ikuti berbagai festival budaya, pameran teknologi, dan acara besar lainnya.</p>
                        </div>
                    </div>
                </div>
                <!-- E-Sports & Gaming Event -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="{{ asset('frontend/assets/img/event.jpg') }}" alt="E-Sports Event">
                        <div class="overlay">
                            <h4>E-Sports & Gaming</h4>
                            <p>Saksikan kompetisi e-sports terbaik dengan ribuan penggemar di stadion.</p>
                        </div>
                    </div>
                </div>
                <!-- Acara Keagamaan -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="{{asset('frontend/assets/img/acara.jpg')}}" alt="Acara Keagamaan">
                        <div class="overlay">
                            <h4>Acara Keagamaan</h4>
                            <p>Ikuti perayaan keagamaan besar dengan ribuan peserta di stadion.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CSS untuk Tampilan Stadion -->
    <style>
        .stadium-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .stadium-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .stadium-card:hover img {
            transform: scale(1.1);
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            text-align: center;
            padding: 10px;
            transition: background 0.3s;
        }

        .stadium-card:hover .overlay {
            background: rgba(0, 0, 0, 0.8);
        }
    </style>

    <!-- CSS untuk Tampilan Acara -->
    <style>
        .event-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .event-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-card:hover img {
            transform: scale(1.1);
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            text-align: center;
            padding: 15px;
            transition: background 0.3s;
        }

        .event-card:hover .overlay {
            background: rgba(0, 0, 0, 0.8);
        }

        .overlay h4 {
            font-size: 20px;
            font-weight: bold;
        }

        .overlay p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .btn-sm {
            font-size: 14px;
            padding: 6px 12px;
        }
    </style>

@endsection
