<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ont;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerActivationController extends Controller
{
    /**
     * Form Aktivasi
     */
    public function create(Customer $customer): View
    {
        $packages = Package::where('status', true)
            ->orderBy('name')
            ->get();

        // Untuk sementara tampilkan semua ONT.
        // Nanti bisa difilter hanya ONT yang belum dipakai.
        $onts = Ont::orderBy('code')->get();

        return view(
            'customers.activate',
            compact(
                'customer',
                'packages',
                'onts'
            )
        );
    }

    /**
     * Simpan Aktivasi
     */
    public function store(
        Request $request,
        Customer $customer
    ): RedirectResponse
    {
        $validated = $request->validate([

            'package_id' => 'required|exists:packages,id',

            'ont_id' => 'required|exists:onts,id',

            'pppoe_username' => 'required|string|max:100',

            'pppoe_password' => 'required|string|max:100',

        ]);

        // Pastikan ONT belum dipakai customer lain
        $used = Customer::where('ont_id', $validated['ont_id'])
            ->whereKeyNot($customer->id)
            ->exists();

        if ($used) {

            return back()
                ->withErrors([
                    'ont_id' => 'ONT sudah digunakan customer lain.',
                ])
                ->withInput();

        }

        DB::transaction(function () use (
            $customer,
            $validated
        ) {

            $customer->update([

                'package_id' => $validated['package_id'],

                'ont_id' => $validated['ont_id'],

                'pppoe_username' => $validated['pppoe_username'],

                'pppoe_password' => $validated['pppoe_password'],

                'status' => 'active',

            ]);

        });

        return redirect()
            ->route('customers.show', $customer)
            ->with(
                'success',
                'Customer berhasil diaktivasi.'
            );
    }
}