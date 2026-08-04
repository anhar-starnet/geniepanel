<?php

namespace App\Http\Controllers;

use App\Helpers\CodeGenerator;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Ont;
use App\Models\Package;
use App\Services\Customer\ResumeCustomer;
use App\Services\Customer\SuspendCustomer;
use App\Services\Customer\TerminateCustomer;
use App\Services\GenieACS\DeviceLive;
use App\Services\GenieACS\DeviceProvisioning;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Services\GenieACS\GenieACSClient;
use App\Services\GenieACS\OntSyncService;

class CustomerController extends Controller
{
    public function __construct(
    protected DeviceProvisioning $deviceProvisioning,
    protected DeviceLive $deviceLive,
    protected GenieACSClient $genieacs,
    protected OntSyncService $ontSync,
) {
}

    /**
 * Refresh parameter ONT dari GenieACS.
 */
public function refresh(
    Customer $customer
): RedirectResponse {

    if (!$customer->ont) {

        return back()->with(
            'error',
            'Customer belum memiliki ONT.'
        );

    }

    if (!$customer->ont->genieacs_device_id) {

        return back()->with(
            'error',
            'ONT belum terhubung ke GenieACS.'
        );

    }

    $this->genieacs->refresh(
        $customer->ont->genieacs_device_id
    );

    return back()->with(
        'success',
        'Refresh task berhasil dikirim ke GenieACS.'
    );

}

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
    public function create(Request $request): View
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

        $device = null;

        if ($request->filled('device')) {
            $device = $this->deviceProvisioning
                ->device($request->string('device')->toString());
        }

        return view(
            'customers.create',
            compact(
                'packages',
                'onts',
                'customerCode',
                'device'
            )
        );
    }

    /**
     * Simpan pelanggan
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $data = $request->validated();

            $data['status'] = 'active';

            Customer::create($data);

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
        'ont.splitterPort',
        'ont.splitterPort.splitter',
        'ont.splitterPort.splitter.odp',
        'ont.splitterPort.splitter.odp.pop',
        'ont.splitterPort.splitter.odp.pop.area',
    ]);

    $this->ontSync->syncCustomer($customer);

    $customer->refresh()->load([
        'package',
        'ont',
        'ont.splitterPort',
        'ont.splitterPort.splitter',
        'ont.splitterPort.splitter.odp',
        'ont.splitterPort.splitter.odp.pop',
        'ont.splitterPort.splitter.odp.pop.area',
    ]);

    $live = $this->deviceLive->customer($customer);

    return view(
        'customers.show',
        compact(
            'customer',
            'live'
        )
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

        return view(
            'customers.edit',
            compact(
                'customer',
                'packages',
                'onts'
            )
        );
    }

    /**
     * Update pelanggan
     */
    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    ): RedirectResponse {

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
    ): RedirectResponse {

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Pelanggan berhasil dihapus.'
            );
    }

    public function suspend(
        Customer $customer,
        SuspendCustomer $service
    ): RedirectResponse {

        $service->handle($customer);

        return back()->with(
            'success',
            'Customer berhasil di-suspend.'
        );
    }

    public function resume(
        Customer $customer,
        ResumeCustomer $service
    ): RedirectResponse {

        $service->handle($customer);

        return back()->with(
            'success',
            'Customer berhasil diaktifkan kembali.'
        );
    }

    public function terminate(
        Customer $customer,
        TerminateCustomer $service
    ): RedirectResponse {

        $service->handle($customer);

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer berhasil diterminasi.'
            );
    }
}