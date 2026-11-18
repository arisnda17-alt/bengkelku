# BengkelKu – Sistem Informasi Bengkel

BengkelKu merupakan aplikasi berbasis web yang dibuat menggunakan framework Laravel untuk membantu pengelolaan data dan aktivitas pelayanan bengkel kendaraan bermotor.

## Fitur Aplikasi

1. **Data Pelanggan** – Mengelola identitas dan informasi pelanggan.
2. **Data Kendaraan** – Mengelola data kendaraan milik pelanggan.
3. **Daftar Service** – Mencatat pendaftaran servis, keluhan kendaraan, dan tanggal servis.
4. **Data Service** – Mengelola estimasi servis, mekanik, dan sparepart pengganti.
5. **Pembayaran Service** – Mencatat biaya dan jenis pembayaran servis.
6. **REST API** – Menyediakan layanan API untuk operasi CRUD menggunakan Postman.

## Teknologi yang Digunakan

- PHP 8.4
- Laravel 13
- MySQL
- HTML, CSS, dan JavaScript
- Bootstrap
- Postman
- Git dan GitHub

## Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/arisnda17-alt/bengkelku.git
cd bengkelku
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Buat File Environment

```bash
cp .env.example .env
```

Pada Windows PowerShell, jika perintah tersebut tidak berjalan, gunakan:

```powershell
Copy-Item .env.example .env
```

### 4. Buat Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

Buat database MySQL dengan nama:

```text
db_bengkelku
```

Sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_bengkelku
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password dengan konfigurasi MySQL masing-masing.

### 6. Jalankan Migration

```bash
php artisan migrate
```

### 7. Jalankan Aplikasi

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua:

```bash
npm run dev
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

## Endpoint REST API

| Modul | Endpoint |
|---|---|
| Pelanggan | `/api/pelanggan` |
| Kendaraan | `/api/kendaraan` |
| Daftar Service | `/api/daftar-service` |
| Data Service | `/api/data-service` |
| Pembayaran | `/api/pembayaran` |

Endpoint API dapat diuji menggunakan Postman dengan metode GET, POST, PUT, dan DELETE.

## Repository

https://github.com/arisnda17-alt/bengkelku

## Pengembang

Proyek ini dibuat sebagai tugas proyek akhir mata kuliah dengan menggunakan Laravel.