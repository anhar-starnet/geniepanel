<?php

namespace App\Http\Controllers;

use App\Models\SplitterPort;

class SplitterPortController extends Controller
{
    /**
     * Detail Port Splitter
     */
    public function show(SplitterPort $splitterPort)
    {
        $splitterPort->load([
            'splitter.odp.pop.area',
        ]);

        return view('splitter-ports.show', compact('splitterPort'));
    }
}