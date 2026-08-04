<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ont;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CustomerOntController extends Controller
{
    /**
     * Form Assign ONT.
     */
    public function create(Customer $customer): View
    {
        $onts = Ont::with([
            'splitterPort.splitter.odp.pop.area',
        ])
        ->whereDoesntHave('customer')
        ->orderBy('code')
        ->get();

        return view(
            'customers.assign-ont',
            compact(
                'customer',
                'onts'
            )
        );
    }

    /**
     * Simpan Assign ONT.
     */
    public function store(
        Request $request,
        Customer $customer
    ): RedirectResponse {

        $request->validate([
            'ont_id' => [
                'required',
                'exists:onts,id',
            ],
        ]);

        DB::transaction(function () use (
            $request,
            $customer
        ) {

            $ont = Ont::with('customer')
                ->lockForUpdate()
                ->findOrFail(
                    $request->ont_id
                );

            if ($ont->customer) {

                throw ValidationException::withMessages([
                    'ont_id' => 'ONT sudah digunakan customer lain.',
                ]);

            }

            $customer->update([

                'ont_id' => $ont->id,

                'serial_number' => $ont->serial_number,

            ]);

        });

        return redirect()
            ->route(
                'customers.show',
                $customer
            )
            ->with(
                'success',
                'ONT berhasil di-assign.'
            );
    }
}