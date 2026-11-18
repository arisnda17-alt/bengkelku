
@extends('layouts.app')

@section('title', 'Daftar Service - BengkelKu')
@section('heading', 'Daftar Service')

@section('content')
<div class="stat-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Daftar Service Kendaraan</h5>
            <small class="text-secondary">Kelola pendaftaran servis pelanggan.</small>
        </div>

        <a href="{{ route('daftar-service.create') }}" class="btn btn-primary">
            + Tambah Daftar Service
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>ID Servis</th>
                    <th>No. Plat</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Keluhan</th>
                    <th>Tanggal Servis</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($daftarServices as $index => $service)
                    <tr>
                        <td>{{ $daftarServices->firstItem() + $index }}</td>
                        <td>{{ $service->id_servis }}</td>
                        <td>{{ $service->no_plat }}</td>
                        <td>{{ $service->id_pelanggan }}</td>
                        <td>{{ $service->pelanggan?->nama_lengkap ?? '-' }}</td>
                        <td>{{ $service->keluhan_kendaraan }}</td>
                        <td>{{ \Carbon\Carbon::parse($service->tanggal_servis)->format('d-m-Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('daftar-service.edit', $service->id_servis) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('daftar-service.destroy', $service->id_servis) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus daftar service ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-secondary py-4">
                            Belum ada daftar service.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $daftarServices->links('pagination::bootstrap-5') }}

</div>
@endsection
