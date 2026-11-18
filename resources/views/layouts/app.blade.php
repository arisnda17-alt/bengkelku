
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BengkelKu')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #172554;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 15px;
            color: white;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            padding: 10px 15px 30px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 6px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .topbar {
            background: white;
            padding: 18px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
            color: #1d4ed8;
        }

        @media(max-width: 768px) {
            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">🏍 BengkelKu</div>

    <small class="text-secondary px-3">MENU UTAMA</small>

    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('pelanggan.index') }}">👥 Data Pelanggan</a>
    <a href="{{ route('kendaraan.index') }}">🏍 Data Kendaraan</a>
    <a href="{{ route('daftar-service.index') }}">📋 Daftar Service</a>
    <a href="{{ route('data-service.index') }}">🔧 Data Service</a>
    <a href="{{ route('pembayaran.index') }}">💰 Pembayaran</a>
</div>

<div class="main-content">
    <div class="topbar d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">@yield('heading', 'Dashboard')</h5>
            <small class="text-secondary">Sistem Informasi Service Motor</small>
        </div>
        <span class="badge text-bg-primary">Administrator</span>
    </div>

    @yield('content')

    <footer class="text-center text-secondary mt-5">
        <small>© {{ date('Y') }} BengkelKu - Sistem Informasi Service Motor</small>
    </footer>
</div>

</body>
</html>
