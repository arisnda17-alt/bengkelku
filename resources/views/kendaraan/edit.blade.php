
@extends('layouts.app')

@section('title', 'Edit Kendaraan - BengkelKu')
@section('heading', 'Edit Kendaraan')

@section('content')
<div class="stat-card">

    <h5 class="fw-bold mb-4">Form Edit Kendaraan</h5>

    <form action="{{ route('kendaraan.update', $kendaraan->no_plat) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nomor Plat</label>
            <input type="text" class="form-control"
                value="{{ $kendaraan->no_plat }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Jenis Kendaraan</label>

            <div class="form-check form-check-inline">
                <input type="radio" name="jenis_kendaraan"
                    id="matic" value="Matic" class="form-check-input"
                    {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Matic' ? 'checked' : '' }}>
                <label for="matic" class="form-check-label">Matic</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="radio" name="jenis_kendaraan"
                    id="manual" value="Manual Transmisi" class="form-check-input"
                    {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Manual Transmisi' ? 'checked' : '' }}>
                <label for="manual" class="form-check-label">Manual Transmisi</label>
            </div>

            @error('jenis_kendaraan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor STNK</label>
            <input type="text" name="no_stnk" class="form-control"
                value="{{ old('no_stnk', $kendaraan->no_stnk) }}">
            @error('no_stnk')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Pembuatan</label>
            <input type="number" name="tahun_pembuatan" class="form-control"
                value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan) }}"
                min="1900" max="{{ date('Y') }}">
            @error('tahun_pembuatan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pemilik</label>
            <input type="text" name="nama_pemilik" class="form-control"
                value="{{ old('nama_pemilik', $kendaraan->nama_pemilik) }}">
            @error('nama_pemilik')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Warna Kendaraan</label>
            <input type="text" name="warna_kendaraan" class="form-control"
                value="{{ old('warna_kendaraan', $kendaraan->warna_kendaraan) }}">
            @error('warna_kendaraan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
