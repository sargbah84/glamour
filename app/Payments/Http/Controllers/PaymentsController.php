<?php

namespace App\Payments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Payment;

class PaymentsController extends Controller
{

    public function redirect($provider, $transaction)
    {
        return Payment::with($provider)->redirect($transaction);
    }


    public function callback(Request $request, $provider)
    {
        return Payment::with($provider)->callback($request);
    }
}
