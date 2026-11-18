<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranController extends Controller
{
    // Menampilkan semua pembayaran
    public function index()
    {
        $pembayarans = Pembayaran::with('daftarService.pelanggan')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil ditampilkan',
            'data' => $pembayarans
        ], 200);
    }

    // Menambahkan pembayaran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => 'required|exists:daftar_services,id_servis|unique:pembayarans,id_servis',
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => [
                'required',
                Rule::in(['Cash / Tunai', 'Non Tunai']),
            ],
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil ditambahkan',
            'data' => $pembayaran->load('daftarService.pelanggan')
        ], 201);
    }

    // Menampilkan detail pembayaran
    public function show(string $id)
    {
        $pembayaran = Pembayaran::with('daftarService.pelanggan')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail pembayaran berhasil ditampilkan',
            'data' => $pembayaran
        ], 200);
    }

    // Mengubah pembayaran
    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'id_servis' => [
                'required',
                'exists:daftar_services,id_servis',
                Rule::unique('pembayarans', 'id_servis')->ignore($id),
            ],
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => [
                'required',
                Rule::in(['Cash / Tunai', 'Non Tunai']),
            ],
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil diperbarui',
            'data' => $pembayaran->load('daftarService.pelanggan')
        ], 200);
    }

    // Menghapus pembayaran
    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil dihapus'
        ], 200);
    }
}
