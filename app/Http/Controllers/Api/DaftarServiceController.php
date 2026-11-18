<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarServiceController extends Controller
{
    // Menampilkan semua daftar service
    public function index()
    {
        $services = DaftarService::with(['pelanggan', 'kendaraan'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil ditampilkan',
            'data' => $services
        ], 200);
    }

    // Menambahkan daftar service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => 'required|string|max:20|unique:daftar_services,id_servis',
            'no_plat' => 'required|exists:kendaraans,no_plat',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $service = DaftarService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil ditambahkan',
            'data' => $service->load(['pelanggan', 'kendaraan'])
        ], 201);
    }

    // Menampilkan detail daftar service
    public function show(string $id)
    {
        $service = DaftarService::with(['pelanggan', 'kendaraan'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail service berhasil ditampilkan',
            'data' => $service
        ], 200);
    }

    // Mengubah daftar service
    public function update(Request $request, string $id)
    {
        $service = DaftarService::findOrFail($id);

        $validated = $request->validate([
            'id_servis' => [
                'required',
                'string',
                'max:20',
                Rule::unique('daftar_services', 'id_servis')
                    ->ignore($id, 'id_servis'),
            ],
            'no_plat' => 'required|exists:kendaraans,no_plat',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil diperbarui',
            'data' => $service->load(['pelanggan', 'kendaraan'])
        ], 200);
    }

    // Menghapus daftar service
    public function destroy(string $id)
    {
        $service = DaftarService::findOrFail($id);
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil dihapus'
        ], 200);
    }
}
