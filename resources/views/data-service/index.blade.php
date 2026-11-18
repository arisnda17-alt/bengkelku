
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Data Service</h3>
            <p class="text-muted mb-0">Daftar pekerjaan servis kendaraan pelanggan.</p>
        </div>

        <a href="{{ route('data-service.create') }}" class="btn btn-primary">
            + Tambah Data Service
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Periksa kembali data yang dimasukkan.
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
                            <th>Keluhan Kendaraan</th>
                            <th>Estimasi Service</th>
                            <th>Nama Mekanik</th>
                            <th>Sparepart Pengganti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($dataServices as $index => $service)
                            <tr>
                                <td>{{ $dataServices->firstItem() + $index }}</td>
                                <td>{{ $service->id_servis }}</td>
                                <td>
                                    {{ $service->daftarService?->pelanggan?->nama_lengkap ?? '-' }}
                                </td>
                                <td>
                                    {{ $service->daftarService?->keluhan_kendaraan ?? '-' }}
                                </td>
                                <td>{{ $service->estimasi_service }}</td>
                                <td>{{ $service->nama_mekanik }}</td>
                                <td>{{ $service->sparepart_pengganti ?: '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('data-service.edit', $service->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('data-service.destroy', $service->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada data service.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $dataServices->links() }}
        </div>
    </div>
</div>
@endsection
