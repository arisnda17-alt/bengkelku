
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold">Edit Data Pelanggan</h3>
    <p class="text-muted">Perbarui informasi pelanggan bengkel.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">ID Pelanggan</label>
                <input type="text" name="id_pelanggan"
                       class="form-control"
                       value="{{ old('id_pelanggan', $pelanggan->id_pelanggan) }}"
                       required>
                @error('id_pelanggan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap"
                       class="form-control"
                       value="{{ old('nama_lengkap', $pelanggan->nama_lengkap) }}"
                       required>
                @error('nama_lengkap')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp', $pelanggan->no_hp) }}"
                       required>
                @error('no_hp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Pelanggan</label>
                <textarea name="alamat_pelanggan"
                          class="form-control" rows="3"
                          required>{{ old('alamat_pelanggan', $pelanggan->alamat_pelanggan) }}</textarea>
                @error('alamat_pelanggan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan"
                       class="form-control"
                       value="{{ old('pekerjaan', $pelanggan->pekerjaan) }}"
                       required>
                @error('pekerjaan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
        </form>

    </div>
</div>
@endsection
