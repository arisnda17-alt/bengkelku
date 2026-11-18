
@extends('layouts.app')

@section('title', 'Data Kendaraan - BengkelKu')
@section('heading', 'Data Kendaraan')

@section('content')
<div class="stat-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Daftar Kendaraan</h5>
            <small class="text-secondary">Kelola data kendaraan pelanggan bengkel.</small>
        </div>

        <a href="{{ route('kendaraan.create') }}" class="btn btn-primary">
            + Tambah Kendaraan
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
                    <th>No. Plat</th>
                    <th>Jenis Kendaraan</th>
                    <th>No. STNK</th>
                    <th>Tahun</th>
                    <th>Nama Pemilik</th>
                    <th>Warna</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kendaraans as $index => $kendaraan)
                    <tr>
                        <td>{{ $kendaraans->firstItem() + $index }}</td>
                        <td>{{ $kendaraan->no_plat }}</td>
                        <td>{{ $kendaraan->jenis_kendaraan }}</td>
                        <td>{{ $kendaraan->no_stnk }}</td>
                        <td>{{ $kendaraan->tahun_pembuatan }}</td>
                        <td>{{ $kendaraan->nama_pemilik }}</td>
                        <td>{{ $kendaraan->warna_kendaraan }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('kendaraan.edit', $kendaraan->no_plat) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('kendaraan.destroy', $kendaraan->no_plat) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
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
                            Belum ada data kendaraan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $kendaraans->links('pagination::bootstrap-5') }}

</div>
@endsection
