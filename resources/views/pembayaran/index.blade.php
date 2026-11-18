
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Pembayaran Service</h3>
            <p class="text-muted mb-0">Daftar pembayaran servis kendaraan pelanggan.</p>
        </div>

        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">
            + Tambah Pembayaran
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>ID Servis</th>
                            <th>Nama Pelanggan</th>
                            <th>Jumlah Biaya</th>
                            <th>Jenis Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pembayarans as $index => $pembayaran)
                            <tr>
                                <td>{{ $pembayarans->firstItem() + $index }}</td>
                                <td>{{ $pembayaran->id_servis }}</td>
                                <td>
                                    {{ $pembayaran->daftarService?->pelanggan?->nama_lengkap ?? '-' }}
                                </td>
                                <td>
                                    Rp {{ number_format($pembayaran->jumlah_biaya, 0, ',', '.') }}
                                </td>
                                <td>{{ $pembayaran->jenis_pembayaran }}</td>
                                <td>{{ $pembayaran->keterangan ?: '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('pembayaran.edit', $pembayaran->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada data pembayaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $pembayarans->links() }}
        </div>
    </div>
</div>
@endsection
