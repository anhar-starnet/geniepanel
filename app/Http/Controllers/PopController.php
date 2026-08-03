<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Pop;
use Illuminate\Http\Request;

class PopController extends Controller
{
    public function index()
    {
        $pops = Pop::with('area')
            ->orderBy('code')
            ->get();

        return view('pops.index', compact('pops'));
    }

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'area_id'        => 'required|exists:areas,id',
            'code'           => 'required|unique:pops',
            'name'           => 'required|max:100',
            'mikrotik_name'  => 'nullable|max:100',
            'olt_name'       => 'nullable|max:100',
            'ip_address'     => 'nullable|ip',
            'address'        => 'nullable',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'description'    => 'nullable',
            'status'         => 'required|boolean',
        ]);

        Pop::create($validated);

        return redirect()
            ->route('pops.index')
            ->with('success', 'POP berhasil ditambahkan.');
    }

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

    public function update(Request $request, Pop $pop)
    {
        $validated = $request->validate([
            'area_id'        => 'required|exists:areas,id',
            'code'           => 'required|unique:pops,code,' . $pop->id,
            'name'           => 'required|max:100',
            'mikrotik_name'  => 'nullable|max:100',
            'olt_name'       => 'nullable|max:100',
            'ip_address'     => 'nullable|ip',
            'address'        => 'nullable',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'description'    => 'nullable',
            'status'         => 'required|boolean',
        ]);

        $pop->update($validated);

        return redirect()
            ->route('pops.index')
            ->with('success', 'POP berhasil diperbarui.');
    }

    public function destroy(Pop $pop)
    {
        $pop->delete();

        return redirect()
            ->route('pops.index')
            ->with('success', 'POP berhasil dihapus.');
    }
}