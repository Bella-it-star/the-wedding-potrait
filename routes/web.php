<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestImportController;
use App\Http\Controllers\SouvenirRedemptionController;

Route::get('/', function () {
    return view('welcome');
});

// SEMENTARA DI-BYPASS (Tanpa login dulu biar bisa langsung dicoba)
Route::group([], function () {
    
    // URL untuk Kelola Tamu, Pencarian, dan Check-in, Delete
    Route::resource('guests', GuestController::class);
    Route::post('/guests/{guest}/checkin', [GuestController::class, 'checkin'])->name('guests.checkin');
    Route::delete('/guests/{id}', [GuestController::class, 'destroy'])->name('guests.destroy');

    // URL untuk Import Excel (Sementara dilepas middleware admin-nya biar bisa ditest)
    Route::get('/import-guests', [GuestImportController::class, 'create'])->name('guests.import.index');
    Route::post('/import-guests', [GuestImportController::class, 'store'])->name('guests.import.store');

    // URL untuk Meja Penukaran Souvenir Terpisah
    Route::get('/souvenir-desk', [SouvenirRedemptionController::class, 'index'])->name('souvenir.desk');
    Route::post('/souvenir-desk/redeem', [SouvenirRedemptionController::class, 'redeem'])->name('souvenir.redeem');
    
});