
@extends('layouts.app')

@section('title', 'Dashboard - BengkelKu')
@section('heading', 'Dashboard')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold">Selamat Datang di BengkelKu!</h4>
    <p class="text-secondary">
        Kelola data pelanggan, kendaraan, service, dan pembayaran bengkel.
    </p>
</div>

<div class="row g-3">

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="text-secondary">Total Pelanggan</div>
            <div class="stat-number">
                {{ \App\Models\Pelanggan::count() }}
            </div>
            <small class="text-secondary">Data pelanggan terdaftar</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="text-secondary">Total Kendaraan</div>
            <div class="stat-number">
                {{ \App\Models\Kendaraan::count() }}
            </div>
            <small class="text-secondary">Kendaraan terdaftar</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="text-secondary">Daftar Service</div>
            <div class="stat-number">
                {{ \App\Models\DaftarService::count() }}
            </div>
            <small class="text-secondary">Jumlah pendaftaran service</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="text-secondary">Pembayaran</div>
            <div class="stat-number">
                {{ \App\Models\Pembayaran::count() }}
            </div>
            <small class="text-secondary">Transaksi pembayaran</small>
        </div>
    </div>

</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="stat-card">
            <h5 class="fw-bold mb-3">Informasi Aplikasi</h5>
            <p class="text-secondary">
                BengkelKu merupakan aplikasi berbasis web yang digunakan
                untuk membantu pengelolaan administrasi service motor.
                Aplikasi ini memiliki fitur pengelolaan pelanggan,
                kendaraan, daftar service, data service, dan pembayaran.
            </p>
        </div>
    </div>
</div>

@endsection
