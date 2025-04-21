@extends('layouts.backend.admin')

@section('halaman')Pengguna @endsection
@section('judul')Pengguna @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark">Daftar Pengguna - {{ Auth::user()->name }}</h4>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="bg-gradient-dark text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengguna as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pengguna.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                    <form id="destroy-form-{{ $item->id }}" action="{{ route('pengguna.destroy', $item->id) }}" method="POST" class="d-none">
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

    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
                document.getElementById('destroy-form-' + id).submit();
            }
        }
    </script>
@endsection
