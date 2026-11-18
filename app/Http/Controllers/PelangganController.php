<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->paginate(10);

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|string|max:20|unique:pelanggans,id_pelanggan',
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
        ]);

        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus!');
    }
}
