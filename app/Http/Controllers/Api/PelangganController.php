<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    // Menampilkan semua pelanggan
    public function index()
    {
        $pelanggan = Pelanggan::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil ditampilkan',
            'data' => $pelanggan
        ], 200);
    }

    // Menambahkan pelanggan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|string|max:20|unique:pelanggans,id_pelanggan',
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil ditambahkan',
            'data' => $pelanggan
        ], 201);
    }

    // Menampilkan satu pelanggan
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $pelanggan
        ], 200);
    }

    // Mengubah data pelanggan
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'id_pelanggan' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pelanggans', 'id_pelanggan')->ignore($id, 'id_pelanggan'),
            ],
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
        ]);

        $pelanggan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diperbarui',
            'data' => $pelanggan
        ], 200);
    }

    // Menghapus pelanggan
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil dihapus'
        ], 200);
    }
}
