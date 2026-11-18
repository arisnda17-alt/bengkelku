
@extends('layouts.app')

@section('title', 'Tambah Daftar Service - BengkelKu')
@section('heading', 'Tambah Daftar Service')

@section('content')
<div class="stat-card">

    <h5 class="fw-bold mb-4">Form Pendaftaran Service</h5>

    @if($pelanggans->isEmpty() || $kendaraans->isEmpty())
        <div class="alert alert-warning">
            Data pelanggan dan kendaraan harus tersedia terlebih dahulu.
            Silakan isi menu Data Pelanggan dan Data Kendaraan sebelum mendaftarkan service.
        </div>
    @endif

    <form action="{{ route('daftar-service.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">ID Servis Pelanggan</label>
            <input type="text" name="id_servis"
                class="form-control @error('id_servis') is-invalid @enderror"
                value="{{ old('id_servis') }}"
                placeholder="Contoh: SRV001">
            @error('id_servis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Plat Kendaraan</label>
            <select name="no_plat"
                class="form-select @error('no_plat') is-invalid @enderror">
                <option value="">-- Pilih Nomor Plat --</option>
                @foreach($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->no_plat }}"
                        {{ old('no_plat') == $kendaraan->no_plat ? 'selected' : '' }}>
                        {{ $kendaraan->no_plat }} - {{ $kendaraan->nama_pemilik }}
                    </option>
                @endforeach
            </select>
            @error('no_plat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">ID Pelanggan</label>
            <select name="id_pelanggan" id="id_pelanggan"
                class="form-select @error('id_pelanggan') is-invalid @enderror">
                <option value="">-- Pilih ID Pelanggan --</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id_pelanggan }}"
                        data-nama="{{ $pelanggan->nama_lengkap }}"
                        {{ old('id_pelanggan') == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                        {{ $pelanggan->id_pelanggan }}
                    </option>
                @endforeach
            </select>
            @error('id_pelanggan')
                <div class="invalid-feedback">{{ $message }}</div>
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
                class="form-control @error('keluhan_kendaraan') is-invalid @enderror"
                placeholder="Jelaskan keluhan kendaraan">{{ old('keluhan_kendaraan') }}</textarea>
            @error('keluhan_kendaraan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Tanggal Servis</label>
            <input type="date" name="tanggal_servis"
                class="form-control @error('tanggal_servis') is-invalid @enderror"
                value="{{ old('tanggal_servis', date('Y-m-d')) }}">
            @error('tanggal_servis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary"
            {{ $pelanggans->isEmpty() || $kendaraans->isEmpty() ? 'disabled' : '' }}>
            Simpan Data
        </button>

        <a href="{{ route('daftar-service.index') }}" class="btn btn-secondary">
            Kembali
        </a>
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
