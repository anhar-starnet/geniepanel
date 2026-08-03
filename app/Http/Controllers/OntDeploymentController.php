<?php

namespace App\Http\Controllers;

use App\Models\Ont;
use App\Models\SplitterPort;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OntDeploymentController extends Controller
{
    /**
     * Form Deploy ONT
     */
    public function create(Ont $ont): View
    {
        $ports = SplitterPort::with([
            'splitter.odp.pop.area',
        ])
        ->where('status', 'FREE')
        ->doesntHave('ont')
        ->orderBy('splitter_id')
        ->orderBy('port_number')
        ->get();

        return view('onts.deploy', compact(
            'ont',
            'ports'
        ));
    }

    /**
     * Proses Deploy
     */
    public function store(
    Request $request,
    Ont $ont
): RedirectResponse {

    $request->validate([
        'splitter_port_id' => [
            'required',
            'exists:splitter_ports,id',
        ],
    ]);

    DB::transaction(function () use ($request, $ont) {

        $port = SplitterPort::lockForUpdate()->findOrFail(
            $request->splitter_port_id
        );

        if ($port->status !== 'FREE') {

            throw ValidationException::withMessages([
                'splitter_port_id' => 'Port sudah digunakan.',
            ]);

        }

        if ($ont->splitter_port_id !== null) {

            throw ValidationException::withMessages([
                'splitter_port_id' => 'ONT sudah terpasang.',
            ]);

        }

        $ont->update([

            'splitter_port_id' => $port->id,

        ]);

        $port->update([

            'status' => 'USED',

        ]);

    });

    return redirect()
        ->route('onts.index')
        ->with(
            'success',
            'ONT berhasil dideploy.'
        );
}

    /**
     * Lepaskan ONT
     */
    public function release(Ont $ont): RedirectResponse
{
    DB::transaction(function () use ($ont) {

        if ($ont->splitter_port_id === null) {

            throw ValidationException::withMessages([
                'ont' => 'ONT tidak sedang terpasang.',
            ]);

        }

        $port = SplitterPort::lockForUpdate()
            ->findOrFail($ont->splitter_port_id);

        $ont->update([
            'splitter_port_id' => null,
        ]);

        $port->update([
            'status' => 'FREE',
        ]);

    });

    return redirect()
        ->route('onts.index')
        ->with(
            'success',
            'ONT berhasil dilepaskan ke gudang.'
        );
}

    /**
     * Pindahkan ONT
     */
    public function move(Ont $ont)
    {
        abort(501, 'Belum diimplementasikan.');
    }
}