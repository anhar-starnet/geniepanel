<?php

namespace App\Http\Controllers;

use App\Helpers\CodeGenerator;
use App\Http\Requests\StoreOdpRequest;
use App\Http\Requests\UpdateOdpRequest;
use App\Models\Odp;
use App\Models\Pop;

class OdpController extends Controller
{
    /**
     * Daftar ODP
     */
    public function index()
    {
        $odps = Odp::with('pop')
            ->orderBy('code')
            ->get();

        return view('odps.index', compact('odps'));
    }

    /**
     * Form tambah ODP
     */
    public function create()
    {
        $pops = Pop::where('status', true)
            ->orderBy('name')
            ->get();

        $odpCode = CodeGenerator::generate(
            'ODP',
            Odp::class,
            4
        );

        return view('odps.create', compact(
            'pops',
            'odpCode'
        ));
    }

    /**
     * Simpan ODP
     */
    public function store(StoreOdpRequest $request)
    {
        Odp::create($request->validated());

        return redirect()
            ->route('odps.index')
            ->with('success', 'ODP berhasil ditambahkan.');
    }

    /**
     * Form edit ODP
     */
    public function edit(Odp $odp)
    {
        $pops = Pop::where('status', true)
            ->orderBy('name')
            ->get();

        return view('odps.edit', compact(
            'odp',
            'pops'
        ));
    }

    /**
     * Update ODP
     */
    public function update(
        UpdateOdpRequest $request,
        Odp $odp
    ) {
        $odp->update($request->validated());

        return redirect()
            ->route('odps.index')
            ->with('success', 'ODP berhasil diperbarui.');
    }

    /**
     * Hapus ODP
     */
    public function destroy(Odp $odp)
    {
        $odp->delete();

        return redirect()
            ->route('odps.index')
            ->with('success', 'ODP berhasil dihapus.');
    }
}