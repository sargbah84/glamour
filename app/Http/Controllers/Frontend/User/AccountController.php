<?php

namespace App\Http\Controllers\Frontend\User;

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
}
