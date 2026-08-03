<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;

class PackageController extends Controller
{
    public function index()
{
    $packages = Package::orderBy('id', 'desc')->get();

    return view('packages.index', compact('packages'));
}
    public function create()
    {
        return view('packages.create');
    }

    public function store(StorePackageRequest $request)
    {
        Package::create($request->validated());

        return redirect()
            ->route('packages.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->validated());

        return redirect()
            ->route('packages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()
            ->route('packages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }
}
