@extends('layouts.backend.admin')

@section('halaman')
    Tiket
@endsection
@section('judul')
    Tiket
@endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark">Daftar Tiket</h4>
                @if (request()->has('kategori'))
                    <h5 class="text-primary mt-2">
                        Menampilkan Tiket Kategori: <strong>{{ request('kategori') }}</strong>
                    </h5>
                @endif

                <a href="{{ route('tiket.create') }}" class="btn btn-primary px-4">
                    <i class="mdi mdi-plus-circle me-1"></i> Tambah Tiket
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="bg-gradient-dark text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Pertandingan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tiket->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada tiket tersedia untuk kategori
                                    ini.</td>
                            </tr>
                        @else
                            @foreach ($tiket as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ number_format($item->stok) }}</td>
                                    <td class="text-center">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->kategori }}</td>
                                    <td class="text-center">
                                        @if ($item->status == 'Tersedia')
                                            <span class="badge bg-success text-white">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger text-white">Habis</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->acara->nama_pertandingan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tiket.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                        <form id="destroy-form-{{ $item->id }}"
                                            action="{{ route('tiket.destroy', $item->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan SweetAlert2 -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('destroy-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
