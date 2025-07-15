<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HoldingController;
use App\Http\Controllers\HoldingImportController;
use App\Http\Controllers\HoldingSampleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(["middleware" => "auth"], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('clients', ClientController::class);
    Route::resource('holdings', HoldingController::class);

    Route::prefix('holdings-data')->group(function () {
        Route::get('/sample-template', [HoldingSampleController::class, 'download'])
            ->name('holdings.sample.download');

        Route::get('/import', [HoldingImportController::class, 'showForm'])->name('holdings.import.form');
        Route::post('/import', [HoldingImportController::class, 'import'])->name('holdings.import');
    });

    Route::prefix('reports')->group(function () {
        Route::prefix('client-wise')->group(function () {
            Route::get('/', [ReportController::class, 'clientWise'])->name('reports.client-wise');
            Route::get('/pdf', [ReportController::class, 'exportClientWisePdf'])->name('reports.client-wise.pdf');
            Route::get('/excel', [ReportController::class, 'exportClientWiseExcel'])->name('reports.client-wise.excel');
        });

        Route::prefix('sector-wise')->group(function () {
            Route::get('/', [ReportController::class, 'sectorWise'])->name('reports.sector-wise');
        });


    });

});

require __DIR__.'/auth.php';
