
@extends('layouts.app')

@section('title', 'Edit Daftar Service - BengkelKu')
@section('heading', 'Edit Daftar Service')

@section('content')
<div class="stat-card">

    <h5 class="fw-bold mb-4">Form Edit Daftar Service</h5>

    <form action="{{ route('daftar-service.update', $daftarService->id_servis) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID Servis Pelanggan</label>
            <input type="text" class="form-control"
                value="{{ $daftarService->id_servis }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Plat Kendaraan</label>
            <select name="no_plat" class="form-select">
                <option value="">-- Pilih Nomor Plat --</option>
                @foreach($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->no_plat }}"
                        {{ old('no_plat', $daftarService->no_plat) == $kendaraan->no_plat ? 'selected' : '' }}>
                        {{ $kendaraan->no_plat }} - {{ $kendaraan->nama_pemilik }}
                    </option>
                @endforeach
            </select>
            @error('no_plat')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">ID Pelanggan</label>
            <select name="id_pelanggan" id="id_pelanggan" class="form-select">
                <option value="">-- Pilih ID Pelanggan --</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id_pelanggan }}"
                        data-nama="{{ $pelanggan->nama_lengkap }}"
                        {{ old('id_pelanggan', $daftarService->id_pelanggan) == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                        {{ $pelanggan->id_pelanggan }}
                    </option>
                @endforeach
            </select>
            @error('id_pelanggan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pelanggan</label>
            <input type="text" id="nama_pelanggan"
                class="form-control" readonly
                placeholder="Nama pelanggan akan muncul otomatis">
        </div>

        <div class="mb-3">
            <label class="form-label">Keluhan Kendaraan</label>
            <textarea name="keluhan_kendaraan" rows="3"
                class="form-control">{{ old('keluhan_kendaraan', $daftarService->keluhan_kendaraan) }}</textarea>
            @error('keluhan_kendaraan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Tanggal Servis</label>
            <input type="date" name="tanggal_servis"
                class="form-control"
                value="{{ old('tanggal_servis', \Carbon\Carbon::parse($daftarService->tanggal_servis)->format('Y-m-d')) }}">
            @error('tanggal_servis')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="{{ route('daftar-service.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    const pelangganSelect = document.getElementById('id_pelanggan');
    const namaPelanggan = document.getElementById('nama_pelanggan');

    function tampilkanNamaPelanggan() {
        const pilihan = pelangganSelect.options[pelangganSelect.selectedIndex];
        namaPelanggan.value = pilihan ? (pilihan.dataset.nama || '') : '';
    }

    pelangganSelect.addEventListener('change', tampilkanNamaPelanggan);
    tampilkanNamaPelanggan();
</script>
@endsection
