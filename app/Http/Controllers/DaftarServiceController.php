<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarServiceController extends Controller
{
    public function index()
    {
        $daftarServices = DaftarService::with(['pelanggan', 'kendaraan'])
            ->latest()
            ->paginate(10);

        return view('daftar-service.index', compact('daftarServices'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_lengkap')->get();
        $kendaraans = Kendaraan::orderBy('no_plat')->get();

        return view('daftar-service.create', compact(
            'pelanggans',
            'kendaraans'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => 'required|string|max:20|unique:daftar_services,id_servis',
            'no_plat' => 'required|exists:kendaraans,no_plat',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        DaftarService::create($validated);

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil ditambahkan!');
    }

    public function edit(DaftarService $daftarService)
    {
        $pelanggans = Pelanggan::orderBy('nama_lengkap')->get();
        $kendaraans = Kendaraan::orderBy('no_plat')->get();

        return view('daftar-service.edit', compact(
            'daftarService',
            'pelanggans',
            'kendaraans'
        ));
    }

    public function update(Request $request, DaftarService $daftarService)
    {
        $validated = $request->validate([
            'no_plat' => 'required|exists:kendaraans,no_plat',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $daftarService->update($validated);

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil diperbarui!');
    }

    public function destroy(DaftarService $daftarService)
    {
        $daftarService->delete();

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil dihapus!');
    }
}
