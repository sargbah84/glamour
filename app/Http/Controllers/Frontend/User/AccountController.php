<?php

namespace App\Http\Controllers\Frontend\User;

use App\Payments\Models\PaymentsIPay;
use App\Payments\Models\PaymentsUniPay;
use App\Payments\Processors\UniPayProcessor;
use Auth;
use Illuminate\Http\Request;
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

    public function pay(Request $request, Plan $plan)
    {
        if($request->input('payment_gateway') == 'unipay') {
            $transaction = PaymentsUniPay::create([
                'user_id' => Auth::user()->id,
                'plan_id' => $plan->id,
                'price' => $plan->price,
                'currency' => $plan->currency,
                'status' => UniPayProcessor::$STATUS[1000]
            ]);

            return redirect(action('\App\Payments\Http\Controllers\PaymentsController@redirect', [
                'provider' => 'unipay',
                'order' => $transaction->id,
            ]));

        } else {
            $transaction = PaymentsIPay::create([
                'user_id' => Auth::user()->id,
                'plan_id' => $plan->id,
                'price' => $plan->price,
                'currency' => $plan->currency,
                'status' => UniPayProcessor::$STATUS[1000]
            ]);

            return redirect(action('\App\Payments\Http\Controllers\PaymentsController@redirect', [
                'provider' => 'ipay',
                'order' => $transaction->id,
            ]));
        }
    }
}
