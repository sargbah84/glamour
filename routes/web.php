<?php

use App\Http\Controllers\LocaleController;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__ . '/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__ . '/backend/');
});

Route::get('test', function () {
    $request = [
        'UnipayOrderID' => 'MP500528261B4B0BF0C535',
        'MerchantOrderID ' => '8',
        'Status ' => '3',
        'SecretKey' => config('payments.gateways.unipay.secretKey'),
    ];
    $hashString = implode('|', $request);
    return hash('sha256', $hashString);
});
