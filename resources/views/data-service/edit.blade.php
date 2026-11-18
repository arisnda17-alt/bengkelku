
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold">Edit Data Service</h3>
        <p class="text-muted">Perbarui informasi pekerjaan servis kendaraan.</p>
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

            <form action="{{ route('data-service.update', $dataService->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">ID Servis Pelanggan</label>

                    <select name="id_servis" id="id_servis" class="form-select" required>
                        @foreach($daftarServices as $service)
                            <option
                                value="{{ $service->id_servis }}"
                                data-keluhan="{{ $service->keluhan_kendaraan }}"
                                {{ old('id_servis', $dataService->id_servis) == $service->id_servis ? 'selected' : '' }}>
                                {{ $service->id_servis }} -
                                {{ $service->pelanggan?->nama_lengkap ?? 'Pelanggan' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keluhan Kendaraan</label>
                    <textarea id="keluhan_kendaraan"
                              class="form-control"
                              rows="3"
                              readonly></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estimasi Service</label>
                    <input type="text"
                           name="estimasi_service"
                           class="form-control"
                           value="{{ old('estimasi_service', $dataService->estimasi_service) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Mekanik</label>
                    <input type="text"
                           name="nama_mekanik"
                           class="form-control"
                           value="{{ old('nama_mekanik', $dataService->nama_mekanik) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sparepart Pengganti</label>
                    <textarea name="sparepart_pengganti"
                              class="form-control"
                              rows="3">{{ old('sparepart_pengganti', $dataService->sparepart_pengganti) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('data-service.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const pilihanServis = document.getElementById('id_servis');
    const keluhan = document.getElementById('keluhan_kendaraan');

    function tampilkanKeluhan() {
        const option = pilihanServis.options[pilihanServis.selectedIndex];

        keluhan.value = option ? (option.dataset.keluhan || '') : '';
    }

    pilihanServis.addEventListener('change', tampilkanKeluhan);

    tampilkanKeluhan();
</script>
@endsection
