<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id')->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

public function store(Request $request)
{
    $request->validate([
        'customer_code' => 'required|unique:customers',
        'name'          => 'required',
        'phone'         => 'nullable',
        'email'         => 'nullable|email',
        'address'       => 'nullable',
        'status'        => 'required',
    ]);

    Customer::create($request->all());

    return redirect()
        ->route('customers.index')
        ->with('success', 'Pelanggan berhasil ditambahkan.');
}

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
    return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
{
    $request->validate([
        'customer_code' => 'required',
        'name'          => 'required',
        'phone'         => 'nullable',
        'email'         => 'nullable|email',
        'address'       => 'nullable',
        'status'        => 'required',
    ]);

    $customer->update($request->all());

    return redirect()
        ->route('customers.index')
        ->with('success', 'Data pelanggan berhasil diubah.');
}

    public function destroy(Customer $customer)
{
    $customer->delete();

    return redirect()
        ->route('customers.index')
        ->with('success', 'Pelanggan berhasil dihapus.');
}

}
