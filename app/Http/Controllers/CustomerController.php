<?php

namespace App\Http\Controllers;

use App\Helpers\CodeGenerator;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Ont;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    /**
     * Daftar pelanggan
     */
    public function index(): View
    {
        $customers = Customer::with([
            'package',
            'ont',
        ])
        ->orderBy('customer_code')
        ->get();

        return view('customers.index', compact('customers'));
    }

    /**
     * Form tambah pelanggan
     */
    public function create(): View
    {
        $packages = Package::where('status', true)
            ->orderBy('name')
            ->get();

        $onts = Ont::orderBy('code')->get();

        $customerCode = CodeGenerator::generate(
            'CST',
            Customer::class,
            6
        );

        return view('customers.create', compact(
            'packages',
            'onts',
            'customerCode'
        ));
    }

    /**
     * Simpan pelanggan
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            Customer::create(
                $request->validated()
            );

        });

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Pelanggan berhasil ditambahkan.'
            );
    }

    /**
     * Detail pelanggan
     */
    public function show(Customer $customer): View
    {
        $customer->load([
            'package',
            'ont',
            'pop',
            'odp',
        ]);

        return view(
            'customers.show',
            compact('customer')
        );
    }

    /**
     * Form edit
     */
    public function edit(Customer $customer): View
    {
        $packages = Package::where('status', true)
            ->orderBy('name')
            ->get();

        $onts = Ont::orderBy('code')->get();

        return view('customers.edit', compact(
            'customer',
            'packages',
            'onts'
        ));
    }

    /**
     * Update pelanggan
     */
    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    ): RedirectResponse
    {
        DB::transaction(function () use (
            $request,
            $customer
        ) {

            $customer->update(
                $request->validated()
            );

        });

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Pelanggan berhasil diperbarui.'
            );
    }

    /**
     * Hapus pelanggan
     */
    public function destroy(
        Customer $customer
    ): RedirectResponse
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Pelanggan berhasil dihapus.'
            );
    }
}