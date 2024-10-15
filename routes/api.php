<?php

use Illuminate\Support\Facades\Route;
use Modules\PSGC\Http\Controllers\CountryController;
use Modules\PSGC\Http\Controllers\PSGCController;

Route::group(attributes: [
    'prefix' => 'psgc',
    'as' => 'psgc.',
], routes: function () {
    Route::get(uri: 'region', action: [PSGCController::class, 'region'])
        ->name('region');
    Route::get(uri: 'province', action: [PSGCController::class, 'province'])
        ->name('province');
    Route::get(uri: 'municipality', action: [PSGCController::class, 'municipality'])
        ->name('municipality');
    Route::get(uri: 'barangay', action: [PSGCController::class, 'barangay'])
        ->name('barangay');
});

Route::get('country', [CountryController::class, 'index'])
    ->name('country');
