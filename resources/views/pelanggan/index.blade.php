
@extends('layouts.app')

@section('title', 'Data Pelanggan - BengkelKu')
@section('heading', 'Data Pelanggan')

@section('content')

<div class="stat-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Daftar Pelanggan</h5>
            <small class="text-secondary">Kelola informasi pelanggan bengkel.</small>
        </div>

        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
            + Tambah Pelanggan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Lengkap</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Pekerjaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pelanggans as $index => $pelanggan)
                    <tr>
                        <td>{{ $pelanggans->firstItem() + $index }}</td>
                        <td>{{ $pelanggan->id_pelanggan }}</td>
                        <td>{{ $pelanggan->nama_lengkap }}</td>
                        <td>{{ $pelanggan->no_hp }}</td>
                        <td>{{ $pelanggan->alamat_pelanggan }}</td>
                        <td>{{ $pelanggan->pekerjaan }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('pelanggan.edit', $pelanggan->id_pelanggan) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('pelanggan.destroy', $pelanggan->id_pelanggan) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
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
                        <td colspan="7" class="text-center text-secondary py-4">
                            Belum ada data pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $pelanggans->links('pagination::bootstrap-5') }}

</div>

@endsection
