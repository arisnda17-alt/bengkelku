<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataServiceController extends Controller
{
    public function index()
    {
        $dataServices = DataService::with('daftarService')
            ->latest()
            ->paginate(10);

        return view('data-service.index', compact('dataServices'));
    }

    public function create()
    {
        $daftarServices = DaftarService::with('pelanggan')
            ->orderByDesc('tanggal_servis')
            ->get();

        return view('data-service.create', compact('daftarServices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => [
                'required',
                'exists:daftar_services,id_servis',
                'unique:data_services,id_servis',
            ],
            'estimasi_service' => 'required|string|max:100',
            'nama_mekanik' => 'required|string|max:100',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        DataService::create($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil ditambahkan!');
    }

    public function edit(DataService $dataService)
    {
        $daftarServices = DaftarService::with('pelanggan')
            ->orderByDesc('tanggal_servis')
            ->get();

        return view(
            'data-service.edit',
            compact('dataService', 'daftarServices')
        );
    }

    public function update(Request $request, DataService $dataService)
    {
        $validated = $request->validate([
            'id_servis' => [
                'required',
                'exists:daftar_services,id_servis',
                Rule::unique('data_services', 'id_servis')
                    ->ignore($dataService->id),
            ],
            'estimasi_service' => 'required|string|max:100',
            'nama_mekanik' => 'required|string|max:100',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $dataService->update($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil diperbarui!');
    }

    public function destroy(DataService $dataService)
    {
        $dataService->delete();

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil dihapus!');
    }
}
