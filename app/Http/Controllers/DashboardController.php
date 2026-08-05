<?php
namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\Odp;
use App\Models\Ont;
use App\Models\Package;
use App\Models\Pop;
use App\Models\Splitter;
use App\Services\GenieACS\AlarmService;
use App\Services\GenieACS\DeviceRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DeviceRepository $devices,
        protected AlarmService $alarms
    ) {}

    public function index(): View
    {
        return view('admin.dashboard', [
            'customerTotal'=>Customer::count(),
            'customerActive'=>Customer::where('status','active')->count(),
            'customerSuspend'=>Customer::where('status','suspend')->count(),
            'customerTerminate'=>Customer::where('status','terminated')->count(),
            'ontTotal'=>Ont::count(),
            'packageTotal'=>Package::count(),
            'areaTotal'=>Area::count(),
            'popTotal'=>Pop::count(),
            'odpTotal'=>Odp::count(),
            'splitterTotal'=>Splitter::count(),
            'recentCustomers'=>Customer::latest()->take(5)->get(),
            'genieacsStats'=>$this->devices->statistics(),
            'alarmSummary'=>$this->alarms->summary(),
        ]);
    }
}
