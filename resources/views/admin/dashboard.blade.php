@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-tachometer-alt"></i>
        Dashboard GeniePanel
    </h1>

    <small class="text-muted">
        {{ now()->format('d F Y H:i') }}
    </small>
</div>
<div class="text-right text-muted mt-2"><small id="dashboard-live-updated">Last Update: -</small></div>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $customerTotal }}</h3>
                <p>Total Customer</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('customers.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $ontTotal }}</h3>
                <p>Total ONT</p>
            </div>
            <div class="icon">
                <i class="fas fa-network-wired"></i>
            </div>
            <a href="{{ route('onts.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $packageTotal }}</h3>
                <p>Paket Internet</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="{{ route('packages.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $splitterTotal }}</h3>
                <p>Splitter</p>
            </div>
            <div class="icon">
                <i class="fas fa-code-branch"></i>
            </div>
            <a href="{{ route('splitters.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header bg-success">

                <h3 class="card-title">

                    Status Customer

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th>Aktif</th>
                    <td>{{ $customerActive }}</td>
                </tr>

                <tr>
                    <th>Suspend</th>
                    <td>{{ $customerSuspend }}</td>
                </tr>

                <tr>
                    <th>Terminasi</th>
                    <td>{{ $customerTerminate }}</td>
                </tr>

            </table>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-header bg-primary">

                <h3 class="card-title">

                    Infrastruktur

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th>Area</th>
                    <td>{{ $areaTotal }}</td>
                </tr>

                <tr>
                    <th>POP</th>
                    <td>{{ $popTotal }}</td>
                </tr>

                <tr>
                    <th>ODP</th>
                    <td>{{ $odpTotal }}</td>
                </tr>

                <tr>
                    <th>Splitter</th>
                    <td>{{ $splitterTotal }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-md-8">

        <div class="card">

            <div class="card-header bg-info">

                <h3 class="card-title">
                    <i class="fas fa-user-clock"></i>
                    Customer Terbaru
                </h3>

            </div>

            <div class="card-body p-0">

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($recentCustomers as $customer)

                        <tr>

                            <td>{{ $customer->customer_code }}</td>

                            <td>{{ $customer->name }}</td>

                            <td>

                                <span class="badge badge-{{ $customer->badgeClass() }}">

                                    {{ $customer->statusText() }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                Belum ada customer.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-header bg-secondary">

                <h3 class="card-title">

                    <i class="fas fa-bolt"></i>

                    Shortcut

                </h3>

            </div>

            <div class="card-body">

                <a href="{{ route('customers.index') }}"
                   class="btn btn-primary btn-block mb-2">

                    <i class="fas fa-users"></i>

                    Customer

                </a>

                <a href="{{ route('onts.index') }}"
                   class="btn btn-success btn-block mb-2">

                    <i class="fas fa-network-wired"></i>

                    ONT

                </a>

                <a href="{{ route('packages.index') }}"
                   class="btn btn-warning btn-block mb-2">

                    <i class="fas fa-box"></i>

                    Paket

                </a>

                <a href="{{ route('areas.index') }}"
                   class="btn btn-info btn-block mb-2">

                    <i class="fas fa-map-marker-alt"></i>

                    Area

                </a>

                <a href="{{ route('pops.index') }}"
                   class="btn btn-dark btn-block mb-2">

                    <i class="fas fa-building"></i>

                    POP

                </a>

                <a href="{{ route('odps.index') }}"
                   class="btn btn-danger btn-block">

                    <i class="fas fa-project-diagram"></i>

                    ODP

                </a>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-header bg-light">

                <h3 class="card-title">

                    <i class="fas fa-chart-line"></i>

                    Monitoring

                </h3>

            </div>

            <div class="card-body text-center text-muted">

                <div class="row">
                    <div class="col-md-3"><div class="small-box bg-success"><div class="inner"><h3>{{ $genieacsStats['online'] ?? 0 }}</h3><p>ONU Online</p></div></div></div>
                    <div class="col-md-3"><div class="small-box bg-danger"><div class="inner"><h3>{{ $genieacsStats['offline'] ?? 0 }}</h3><p>ONU Offline</p></div></div></div>
                    <div class="col-md-3"><div class="small-box bg-primary"><div class="inner"><h3>{{ $genieacsStats['assigned'] ?? 0 }}</h3><p>Assigned</p></div></div></div>
                    <div class="col-md-3"><div class="small-box bg-warning"><div class="inner"><h3>{{ $genieacsStats['unassigned'] ?? 0 }}</h3><p>Unassigned</p></div></div></div>
                </div>
                <hr>
                <h5 class="text-left mb-3">
                    <i class="fas fa-bell text-danger"></i> Active Alarm
                </h5>

                <div class="row">
                    <div class="col-md-2"><div class="small-box bg-danger"><div class="inner"><h3>{{ $alarmSummary['offline'] ?? 0 }}</h3><p>Offline</p></div></div></div>
                    <div class="col-md-2"><div class="small-box bg-warning"><div class="inner"><h3>{{ $alarmSummary['rx_warning'] ?? 0 }}</h3><p>RX Warning</p></div></div></div>
                    <div class="col-md-2"><div class="small-box bg-danger"><div class="inner"><h3>{{ $alarmSummary['rx_critical'] ?? 0 }}</h3><p>RX Critical</p></div></div></div>
                    <div class="col-md-3"><div class="small-box bg-warning"><div class="inner"><h3>{{ $alarmSummary['temp_warning'] ?? 0 }}</h3><p>Temp Warning</p></div></div></div>
                    <div class="col-md-3"><div class="small-box bg-danger"><div class="inner"><h3>{{ $alarmSummary['temp_critical'] ?? 0 }}</h3><p>Temp Critical</p></div></div></div>
                </div>


            </div>

        </div>

    </div>

</div>
<div class="text-right text-muted mt-2"><small id="dashboard-live-updated">Last Update: -</small></div>
@stop

@push('js')
<script>
async function refreshDashboardLive(){
    try{
        const r=await fetch("{{ route('dashboard.live') }}",{
            headers:{'X-Requested-With':'XMLHttpRequest'}
        });
        if(!r.ok) return;
        const s=await r.json();

        const vals={
            online:s.online ?? 0,
            offline:s.offline ?? 0,
            assigned:s.assigned ?? 0,
            unassigned:s.unassigned ?? 0
        };

        document.querySelectorAll('.small-box .inner h3').forEach((el)=>{
            const p=el.nextElementSibling?.textContent?.trim();
            if(p==='ONU Online') el.textContent=vals.online;
            if(p==='ONU Offline') el.textContent=vals.offline;
            if(p==='Assigned') el.textContent=vals.assigned;
            if(p==='Unassigned') el.textContent=vals.unassigned;
        });

        let info=document.getElementById('dashboard-live-updated');
        if(info){
            info.textContent='Last Update: '+new Date().toLocaleTimeString();
        }
    }catch(e){
        console.error(e);
    }
}
setInterval(refreshDashboardLive,30000);
document.addEventListener('DOMContentLoaded',refreshDashboardLive);
</script>
@endpush
