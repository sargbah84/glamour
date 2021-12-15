<?php

use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use Tabuna\Breadcrumbs\Trail;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group(['as' => 'user.', 'middleware' => 'auth'], function () {
    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'));
        });

    Route::get('account/plan', [AccountController::class, 'plan'])
        ->name('account.plan')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.user.account')
                ->push(__('My Plan'), route('frontend.user.account.plan'));
        });

    Route::get('account/order/{plan:slug}', [AccountController::class, 'order'])
        ->name('account.order')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.user.account')
                ->push(__('Place Order'), route('frontend.user.account.order', request()->route()->plan));
        });

    Route::post('account/order/{plan:slug}', [AccountController::class, 'pay'])->name('account.order.pay');

    Route::get('/account/order/{provider}/callback', [AccountController::class, 'callback'])->where('provider',
        implode('|', array_keys(config('payments.gateways'))))->name('account.order.callback');

    /*Route::get('courses', [AccountController::class, 'courses'])
        ->middleware('is_user')
        ->name('courses')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Courses'), route('frontend.user.courses'));
        });*/

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
