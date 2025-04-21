@extends('layouts.backend.admin')

@section('halaman')Pembayaran @endsection
@section('judul')Pembayaran @endsection

@section('content')
    <div class="card bg-white shadow-sm ms-3 me-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark">Daftar Pembayaran</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="bg-gradient-dark text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Pelanggan</th>
                            <th class="text-center">Metode</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tanggal & Waktu</th>
                            <th class="text-center">Jumlah Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->pemesanan->pengguna->nama }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary text-white">{{ $item->metode_pembayaran }}</span>
                                </td>
                                <td class="text-center">
                                    @if($item->status_pembayaran == 'Lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d M Y | H:i') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <strong class="text-success">Rp{{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pembayaran.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                    <form id="destroy-form-{{ $item->id }}" action="{{ route('pembayaran.destroy', $item->id) }}" method="POST" class="d-none">
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
            if (confirm("Apakah Anda yakin ingin menghapus pembayaran ini?")) {
                document.getElementById('destroy-form-' + id).submit();
            }
        }
    </script>
@endsection
