<?php

namespace App\Http\Controllers\Frontend\User;

use Rinvex\Subscriptions\Models\Plan;

/**
 * Class AccountController.
 */
class AccountController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.pages.user.account');
    }

    public function courses()
    {
        return view('frontend.pages.user.courses');
    }

    public function plan()
    {
        return view('frontend.pages.user.plan');
    }

    public function order(Plan $plan)
    {
        return view('frontend.pages.user.order', compact('plan'));
    }
}
