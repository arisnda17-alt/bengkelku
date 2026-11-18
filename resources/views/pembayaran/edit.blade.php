
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold">Edit Pembayaran</h3>
        <p class="text-muted">Perbarui informasi pembayaran servis kendaraan.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pembayaran.update', $pembayaran->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">ID Servis Pelanggan</label>

                    <select name="id_servis" class="form-select" required>
                        @foreach($daftarServices as $service)
                            <option value="{{ $service->id_servis }}"
                                {{ old('id_servis', $pembayaran->id_servis) == $service->id_servis ? 'selected' : '' }}>
                                {{ $service->id_servis }} -
                                {{ $service->pelanggan?->nama_lengkap ?? 'Pelanggan' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Biaya</label>
                    <input type="number"
                           name="jumlah_biaya"
                           class="form-control"
                           value="{{ old('jumlah_biaya', $pembayaran->jumlah_biaya) }}"
                           min="0"
                           step="0.01"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Jenis Pembayaran</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="radio"
                               name="jenis_pembayaran"
                               id="cash"
                               value="Cash / Tunai"
                               {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'Cash / Tunai' ? 'checked' : '' }}
                               required>
                        <label class="form-check-label" for="cash">
                            Cash / Tunai
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="radio"
                               name="jenis_pembayaran"
                               id="non_tunai"
                               value="Non Tunai"
                               {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'Non Tunai' ? 'checked' : '' }}>
                        <label class="form-check-label" for="non_tunai">
                            Non Tunai
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('pembayaran.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
