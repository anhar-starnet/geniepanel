<?php

namespace App\Http\Controllers;

use App\Helpers\CodeGenerator;
use App\Http\Requests\StoreSplitterRequest;
use App\Http\Requests\UpdateSplitterRequest;
use App\Models\Odp;
use App\Models\Splitter;
use App\Models\SplitterPort;

class SplitterController extends Controller
{
    public function index()
    {
        $splitters = Splitter::with('odp')
            ->orderBy('code')
            ->get();

        return view('splitters.index', compact('splitters'));
    }

    public function create()
    {
        $odps = Odp::where('status', true)
            ->orderBy('name')
            ->get();

        $splitterCode = CodeGenerator::generate(
            'SPL',
            Splitter::class,
            4
        );

        return view('splitters.create', compact(
            'odps',
            'splitterCode'
        ));
    }

    public function store(StoreSplitterRequest $request)
    {
        $data = $request->validated();

        $totalPorts = match ($data['ratio']) {
            '1:2'  => 2,
            '1:4'  => 4,
            '1:8'  => 8,
            '1:16' => 16,
            '1:32' => 32,
            '1:64' => 64,
        };

        $data['total_ports'] = $totalPorts;
        $data['used_ports'] = 0;

        $splitter = Splitter::create($data);

        for ($i = 1; $i <= $totalPorts; $i++) {

            SplitterPort::create([

                'splitter_id' => $splitter->id,

                'port_number' => $i,

                'status' => 'FREE',

            ]);

        }

        return redirect()
            ->route('splitters.index')
            ->with('success', 'Splitter berhasil ditambahkan.');
    }

    /**
     * Detail Splitter
     */
    public function show(Splitter $splitter)
    {
        $splitter->load([
            'odp',
            'ports'
        ]);

        return view('splitters.show', compact('splitter'));
    }

    public function edit(Splitter $splitter)
    {
        $odps = Odp::where('status', true)
            ->orderBy('name')
            ->get();

        return view('splitters.edit', compact(
            'splitter',
            'odps'
        ));
    }

    public function update(
        UpdateSplitterRequest $request,
        Splitter $splitter
    ) {
        $data = $request->validated();

        $data['total_ports'] = match ($data['ratio']) {
            '1:2'  => 2,
            '1:4'  => 4,
            '1:8'  => 8,
            '1:16' => 16,
            '1:32' => 32,
            '1:64' => 64,
        };

        $splitter->update($data);

        return redirect()
            ->route('splitters.index')
            ->with('success', 'Splitter berhasil diperbarui.');
    }

    public function destroy(Splitter $splitter)
    {
        $splitter->delete();

        return redirect()
            ->route('splitters.index')
            ->with('success', 'Splitter berhasil dihapus.');
    }
}