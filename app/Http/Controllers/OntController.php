<?php

namespace App\Http\Controllers;

use App\Helpers\CodeGenerator;
use App\Http\Requests\StoreOntRequest;
use App\Http\Requests\UpdateOntRequest;
use App\Models\Ont;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OntController extends Controller
{
    /**
     * Daftar Inventory ONT
     */
    public function index(): View
    {
        $onts = Ont::with('splitterPort.splitter')
            ->latest()
            ->paginate(20);

        return view('onts.index', compact('onts'));
    }

    /**
     * Form tambah ONT
     */
    public function create(): View
    {
        $code = CodeGenerator::generate('ONT', Ont::class);

        return view('onts.create', compact('code'));
    }

    /**
     * Simpan ONT
     */
    public function store(StoreOntRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            Ont::create($request->validated());

        });

        return redirect()
            ->route('onts.index')
            ->with('success', 'Inventory ONT berhasil ditambahkan.');
    }

    /**
     * Detail ONT
     */
    public function show(Ont $ont): View
    {
        $ont->load('splitterPort.splitter.odp.pop.area');

        return view('onts.show', compact('ont'));
    }

    /**
     * Form ubah ONT
     */
    public function edit(Ont $ont): View
    {
        return view('onts.edit', compact('ont'));
    }

    /**
     * Update ONT
     */
    public function update(
        UpdateOntRequest $request,
        Ont $ont
    ): RedirectResponse {

        DB::transaction(function () use ($request, $ont) {

            $ont->update($request->validated());

        });

        return redirect()
            ->route('onts.index')
            ->with('success', 'Inventory ONT berhasil diperbarui.');
    }

    /**
     * Hapus ONT
     */
    public function destroy(Ont $ont): RedirectResponse
    {
        DB::transaction(function () use ($ont) {

            $ont->delete();

        });

        return redirect()
            ->route('onts.index')
            ->with('success', 'Inventory ONT berhasil dihapus.');
    }
}