<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OdpController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SplitterController;
use App\Http\Controllers\SplitterPortController;
use App\Http\Controllers\OntController;
use App\Http\Controllers\OntDeploymentController;
use App\Http\Controllers\CustomerActivationController;
use App\Http\Controllers\CustomerOntController;
/*
|--------------------------------------------------------------------------
| GenieACS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\GenieACS\DeviceController;

Route::prefix('genieacs')
    ->name('genieacs.')
    ->middleware('auth')
    ->group(function () {

        Route::get(
            '/devices',
            [DeviceController::class, 'index']
        )->name('devices.index');

        Route::get(
            '/devices/{serial}',
            [DeviceController::class, 'show']
        )->name('devices.show');

    });
Route::get(
    'customers/{customer}/activate',
    [CustomerActivationController::class, 'create']
)->name('customers.activate');

Route::post(
    'customers/{customer}/activate',
    [CustomerActivationController::class, 'store']
)->name('customers.activate.store');
Route::post(
    'customers/{customer}/suspend',
    [CustomerController::class, 'suspend']
)->name('customers.suspend');

Route::post(
    'customers/{customer}/resume',
    [CustomerController::class, 'resume']
)->name('customers.resume');

Route::delete(
    'customers/{customer}/terminate',
    [CustomerController::class, 'terminate'
])->name('customers.terminate');

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    Route::get(
    'onts/{ont}/deploy',
    [OntDeploymentController::class, 'create']
)->name('onts.deploy');

Route::post(
    'onts/{ont}/deploy',
    [OntDeploymentController::class, 'store']
)->name('onts.deploy.store');

Route::post(
    'onts/{ont}/release',
    [OntDeploymentController::class, 'release']
)->name('onts.release');   

    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */

    Route::resource('packages', PackageController::class)
        ->except('show');
    Route::get(
    'customers/{customer}/assign-ont',
    [CustomerOntController::class, 'create']
)->name('customers.assign-ont');

Route::post(
    'customers/{customer}/assign-ont',
    [CustomerOntController::class, 'store']
)->name('customers.assign-ont.store');

    Route::resource('customers', CustomerController::class);

    Route::resource('areas', AreaController::class)
        ->except('show');

    Route::resource('pops', PopController::class)
        ->except('show');

    Route::resource('odps', OdpController::class)
        ->except('show');

    Route::resource('splitters', SplitterController::class);
    Route::resource('onts', OntController::class);

    /*
    |--------------------------------------------------------------------------
    | Splitter Port
    |--------------------------------------------------------------------------
    */

    Route::get(
        'splitter-ports/{splitterPort}',
        [SplitterPortController::class, 'show']
    )->name('splitter-ports.show');
});

require __DIR__.'/auth.php';
use App\Services\GenieACS\GenieACSClient;

Route::get('/test-genieacs', function (
    GenieACSClient $client
) {

    Route::get('/test-genieacs', function (GenieACSClient $client) {

    return collect($client->devices())

        ->map(function ($device) {

            return [

                'serial'       => $device->serialNumber,

                'vendor'       => $device->manufacturer,

                'model'        => $device->productClass,

                'pppoe'        => $device->pppoeUsername,

                'ip'           => $device->pppoeIP,

                'rx_power'     => $device->rxPower,

                'temperature'  => $device->temperature,

                'uptime'       => $device->uptime,

                'lastInform'   => $device->lastInform,

                'online'       => $device->isOnline(),

            ];

        });

});

});