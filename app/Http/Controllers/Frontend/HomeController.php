<?php

namespace App\Http\Controllers\Frontend;

/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.pages.home');
    }

    public function plans()
    {
        $plans = app('rinvex.subscriptions.plan')->where('is_active', 1)->get();

        return view('frontend.pages.plans', compact('plans'));
    }
}
