
@extends('layouts.app')

@section('title', 'Tambah Pelanggan - BengkelKu')
@section('heading', 'Tambah Pelanggan')

@section('content')

<div class="stat-card">

    <h5 class="fw-bold mb-4">Form Tambah Pelanggan</h5>

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">ID Pelanggan</label>
            <input type="text" name="id_pelanggan"
                class="form-control @error('id_pelanggan') is-invalid @enderror"
                value="{{ old('id_pelanggan') }}"
                placeholder="Contoh: PLG001">

            @error('id_pelanggan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap"
                class="form-control @error('nama_lengkap') is-invalid @enderror"
                value="{{ old('nama_lengkap') }}"
                placeholder="Masukkan nama lengkap">

            @error('nama_lengkap')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="no_hp"
                class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ old('no_hp') }}"
                placeholder="08xxxxxxxxxx">

            @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Pelanggan</label>
            <textarea name="alamat_pelanggan" rows="3"
                class="form-control @error('alamat_pelanggan') is-invalid @enderror"
                placeholder="Masukkan alamat">{{ old('alamat_pelanggan') }}</textarea>

            @error('alamat_pelanggan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan"
                class="form-control @error('pekerjaan') is-invalid @enderror"
                value="{{ old('pekerjaan') }}"
                placeholder="Masukkan pekerjaan">

            @error('pekerjaan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Data
        </button>

        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>
</div>

@endsection
