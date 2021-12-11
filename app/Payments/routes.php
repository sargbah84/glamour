<?php
Route::group([
    'middleware' => ['api'],
    'namespace' => '\App\Payments\Http\Controllers',
    'prefix' => 'payments',
], function () {
    Route::any('{provider}/redirect/{order:plan_id}', 'PaymentsController@redirect')->where('provider',
        implode('|', array_keys(config('payments.gateways'))));
    Route::any('{provider}/callback', 'PaymentsController@callback')->where('provider',
        implode('|', array_keys(config('payments.gateways'))));
});
