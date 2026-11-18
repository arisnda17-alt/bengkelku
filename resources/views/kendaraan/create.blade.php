
@extends('layouts.app')

@section('title', 'Tambah Kendaraan - BengkelKu')
@section('heading', 'Tambah Kendaraan')

@section('content')
<div class="stat-card">

    <h5 class="fw-bold mb-4">Form Tambah Kendaraan</h5>

    <form action="{{ route('kendaraan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nomor Plat</label>
            <input type="text" name="no_plat"
                class="form-control @error('no_plat') is-invalid @enderror"
                value="{{ old('no_plat') }}"
                placeholder="Contoh: BL 1234 AB">
            @error('no_plat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Jenis Kendaraan</label>

            <div class="form-check form-check-inline">
                <input type="radio" name="jenis_kendaraan"
                    id="matic" value="Matic" class="form-check-input"
                    {{ old('jenis_kendaraan') == 'Matic' ? 'checked' : '' }}>
                <label for="matic" class="form-check-label">Matic</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="radio" name="jenis_kendaraan"
                    id="manual" value="Manual Transmisi" class="form-check-input"
                    {{ old('jenis_kendaraan') == 'Manual Transmisi' ? 'checked' : '' }}>
                <label for="manual" class="form-check-label">Manual Transmisi</label>
            </div>

            @error('jenis_kendaraan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor STNK</label>
            <input type="text" name="no_stnk"
                class="form-control @error('no_stnk') is-invalid @enderror"
                value="{{ old('no_stnk') }}"
                placeholder="Masukkan nomor STNK">
            @error('no_stnk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Pembuatan</label>
            <input type="number" name="tahun_pembuatan"
                class="form-control @error('tahun_pembuatan') is-invalid @enderror"
                value="{{ old('tahun_pembuatan') }}"
                min="1900" max="{{ date('Y') }}"
                placeholder="Contoh: 2022">
            @error('tahun_pembuatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pemilik</label>
            <input type="text" name="nama_pemilik"
                class="form-control @error('nama_pemilik') is-invalid @enderror"
                value="{{ old('nama_pemilik') }}"
                placeholder="Masukkan nama pemilik">
            @error('nama_pemilik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Warna Kendaraan</label>
            <input type="text" name="warna_kendaraan"
                class="form-control @error('warna_kendaraan') is-invalid @enderror"
                value="{{ old('warna_kendaraan') }}"
                placeholder="Contoh: Hitam">
            @error('warna_kendaraan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
