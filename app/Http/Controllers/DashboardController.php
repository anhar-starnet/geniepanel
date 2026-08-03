<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\Odp;
use App\Models\Ont;
use App\Models\Package;
use App\Models\Pop;
use App\Models\Splitter;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [

            // Customer
            'customerTotal'      => Customer::count(),
            'customerActive'     => Customer::where('status', 'active')->count(),
            'customerSuspend'    => Customer::where('status', 'suspend')->count(),
            'customerTerminate'  => Customer::where('status', 'terminated')->count(),

            // Inventory
            'ontTotal'           => Ont::count(),
            'packageTotal'       => Package::count(),

            // Network
            'areaTotal'          => Area::count(),
            'popTotal'           => Pop::count(),
            'odpTotal'           => Odp::count(),
            'splitterTotal'      => Splitter::count(),

            // Aktivasi Terbaru
            'recentCustomers' => Customer::latest()
                ->take(5)
                ->get(),

        ]);
    }
}