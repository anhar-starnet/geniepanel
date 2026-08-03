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

    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */

    Route::resource('packages', PackageController::class)
        ->except('show');

    Route::resource('customers', CustomerController::class)
        ->except('show');

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