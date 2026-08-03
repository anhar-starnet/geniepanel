<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Pop;
use App\Http\Requests\StorePopRequest;
use App\Http\Requests\UpdatePopRequest;

class PopController extends Controller
{
    /**
     * Daftar POP
     */
    public function index()
    {
        $pops = Pop::with('area')
            ->orderBy('code')
            ->get();

        return view('pops.index', compact('pops'));
    }

    /**
     * Form tambah POP
     */
    public function create()
    {
        $areas = Area::where('status', true)
            ->orderBy('name')
            ->get();

        $lastId = Pop::max('id') + 1;

        $popCode = 'POP' . str_pad($lastId, 4, '0', STR_PAD_LEFT);

        return view('pops.create', compact(
            'areas',
            'popCode'
        ));
    }

    /**
     * Simpan POP
     */
    public function store(StorePopRequest $request)
    {
        Pop::create($request->validated());

        return redirect()
            ->route('pops.index')
            ->with('success', 'POP berhasil ditambahkan.');
    }

    /**
     * Form edit POP
     */
    public function edit(Pop $pop)
    {
        $areas = Area::where('status', true)
            ->orderBy('name')
            ->get();

        return view('pops.edit', compact(
            'pop',
            'areas'
        ));
    }

    /**
     * Update POP
     */
    public function update(UpdatePopRequest $request, Pop $pop)
    {
        $pop->update($request->validated());

        return redirect()
            ->route('pops.index')
            ->with('success', 'POP berhasil diperbarui.');
    }

    /**
     * Hapus POP
     */
    public function destroy(Pop $pop)
    {
        $pop->delete();

        return redirect()
            ->route('pops.index')
            ->with('success', 'POP berhasil dihapus.');
    }
}