<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Package;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Daftar pelanggan
     */
    public function index()
    {
        $customers = Customer::with('package')
            ->orderBy('customer_code')
            ->get();

        return view('customers.index', compact('customers'));
    }

    /**
     * Form tambah pelanggan
     */
    public function create()
    {
        $packages = Package::where('status', true)
            ->orderBy('name')
            ->get();

        $lastId = Customer::max('id') + 1;

        $customerCode = 'CST' . str_pad($lastId, 6, '0', STR_PAD_LEFT);

        return view('customers.create', compact(
            'packages',
            'customerCode'
        ));
    }

    /**
     * Simpan pelanggan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'customer_code' => 'required|unique:customers',

            'package_id' => 'nullable|exists:packages,id',

            'name' => 'required|string|max:100',
            'nik' => 'nullable|string|max:30',

            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email',

            'address' => 'nullable|string',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            'pppoe_username' => 'nullable|string|max:100',
            'pppoe_password' => 'nullable|string|max:100',

            'serial_number' => 'nullable|string|max:100',

            'status' => 'required',

        ]);

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Form edit pelanggan
     */
    public function edit(Customer $customer)
    {
        $packages = Package::where('status', true)
            ->orderBy('name')
            ->get();

        return view('customers.edit', compact(
            'customer',
            'packages'
        ));
    }

    /**
     * Update pelanggan
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([

            'customer_code' => 'required|unique:customers,customer_code,' . $customer->id,

            'package_id' => 'nullable|exists:packages,id',

            'name' => 'required|string|max:100',
            'nik' => 'nullable|string|max:30',

            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email',

            'address' => 'nullable|string',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            'pppoe_username' => 'nullable|string|max:100',
            'pppoe_password' => 'nullable|string|max:100',

            'serial_number' => 'nullable|string|max:100',

            'status' => 'required',

        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Hapus pelanggan
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}