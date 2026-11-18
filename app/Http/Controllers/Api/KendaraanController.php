<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    // Menampilkan semua kendaraan
    public function index()
    {
        $kendaraan = Kendaraan::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil ditampilkan',
            'data' => $kendaraan
        ], 200);
    }

    // Menambahkan kendaraan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:15|unique:kendaraans,no_plat',
            'jenis_kendaraan' => [
                'required',
                Rule::in(['Matic', 'Manual Transmisi']),
            ],
            'no_stnk' => 'required|string|max:30',
            'tahun_pembuatan' => 'required|integer|digits:4',
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        $kendaraan = Kendaraan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil ditambahkan',
            'data' => $kendaraan
        ], 201);
    }

    // Menampilkan detail kendaraan
    public function show(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail kendaraan berhasil ditampilkan',
            'data' => $kendaraan
        ], 200);
    }

    // Mengubah kendaraan
    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'no_plat' => [
                'required',
                'string',
                'max:15',
                Rule::unique('kendaraans', 'no_plat')->ignore($id, 'no_plat'),
            ],
            'jenis_kendaraan' => [
                'required',
                Rule::in(['Matic', 'Manual Transmisi']),
            ],
            'no_stnk' => 'required|string|max:30',
            'tahun_pembuatan' => 'required|integer|digits:4',
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        $kendaraan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil diperbarui',
            'data' => $kendaraan
        ], 200);
    }

    // Menghapus kendaraan
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil dihapus'
        ], 200);
    }
}
