<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataServiceController extends Controller
{
    // Menampilkan semua data service
    public function index()
    {
        $dataServices = DataService::with('daftarService.pelanggan')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil ditampilkan',
            'data' => $dataServices
        ], 200);
    }

    // Menambahkan data service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => 'required|exists:daftar_services,id_servis|unique:data_services,id_servis',
            'estimasi_service' => 'required|string|max:100',
            'nama_mekanik' => 'required|string|max:100',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $dataService = DataService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil ditambahkan',
            'data' => $dataService->load('daftarService.pelanggan')
        ], 201);
    }

    // Menampilkan detail data service
    public function show(string $id)
    {
        $dataService = DataService::with('daftarService.pelanggan')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data service berhasil ditampilkan',
            'data' => $dataService
        ], 200);
    }

    // Mengubah data service
    public function update(Request $request, string $id)
    {
        $dataService = DataService::findOrFail($id);

        $validated = $request->validate([
            'id_servis' => [
                'required',
                'exists:daftar_services,id_servis',
                Rule::unique('data_services', 'id_servis')->ignore($id),
            ],
            'estimasi_service' => 'required|string|max:100',
            'nama_mekanik' => 'required|string|max:100',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $dataService->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil diperbarui',
            'data' => $dataService->load('daftarService.pelanggan')
        ], 200);
    }

    // Menghapus data service
    public function destroy(string $id)
    {
        $dataService = DataService::findOrFail($id);
        $dataService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil dihapus'
        ], 200);
    }
}
