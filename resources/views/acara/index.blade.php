@extends('layouts.backend.admin')

@section('halaman')
    Pertandingan
@endsection
@section('judul')
    Pertandingan
@endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark">Daftar Pertandingan</h4>
                <a href="{{ route('acara.create') }}" class="btn btn-primary px-4">
                    <i class="mdi mdi-plus-circle me-1"></i> Tambah Pertandingan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="bg-gradient-dark text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Pertandingan</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Waktu Mulai - Selesai</th>
                            <th class="text-center">Stadion</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($acara as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nama_pertandingan }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') }}</td>
                                <td class="text-center">{{ $item->stadion->nama_stadion }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('/storage/public/acaras/' . $item->image) }}" class="rounded"
                                        style="width: 150px">
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('acara.show', $item->id) }}" class="btn btn-sm btn-info me-1">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    <a href="{{ route('acara.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                    <form id="destroy-form-{{ $item->id }}"
                                        action="{{ route('acara.destroy', $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
