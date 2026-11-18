<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::latest()->paginate(10);

        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:15|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|max:30',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        Kendaraan::create($validated);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|max:30',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        $kendaraan->update($validated);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus!');
    }
}
