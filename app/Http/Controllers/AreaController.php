<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Daftar Area
     */
    public function index()
    {
        $areas = Area::orderBy('code')->get();

        return view('areas.index', compact('areas'));
    }

    /**
     * Form tambah Area
     */
    public function create()
    {
        $lastId = Area::max('id') + 1;

        $areaCode = 'AR' . str_pad($lastId, 4, '0', STR_PAD_LEFT);

        return view('areas.create', compact('areaCode'));
    }

    /**
     * Simpan Area
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:areas',
            'name' => 'required|max:100',
            'pic' => 'nullable|max:100',
            'phone' => 'nullable|max:30',
            'address' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        Area::create($validated);

        return redirect()
            ->route('areas.index')
            ->with('success', 'Area berhasil ditambahkan.');
    }

    /**
     * Form edit Area
     */
    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    /**
     * Update Area
     */
    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'code' => 'required|unique:areas,code,' . $area->id,
            'name' => 'required|max:100',
            'pic' => 'nullable|max:100',
            'phone' => 'nullable|max:30',
            'address' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        $area->update($validated);

        return redirect()
            ->route('areas.index')
            ->with('success', 'Area berhasil diperbarui.');
    }

    /**
     * Hapus Area
     */
    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()
            ->route('areas.index')
            ->with('success', 'Area berhasil dihapus.');
    }
}