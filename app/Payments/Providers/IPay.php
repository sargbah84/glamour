<?php

namespace App\Payments\Providers;

use App\Payments\Contracts\Provider;
use App\Payments\Events\IPayPaymentProcessed;
use App\Payments\Models\PaymentsIPay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Zorb\IPay\Enums\CheckoutStatus;
use Zorb\IPay\Enums\Intent;
use Zorb\IPay\Facades\IPay as Bog;

class IPay extends AbstractProvider implements Provider
{

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
    }


    /**
     * Payment redirect method
     *
     * @param $transaction
     * @return Redirector|RedirectResponse
     */
    public function redirect($transaction)
    {

        $transaction = PaymentsIPay::with('user', 'plan')->where('id', $transaction)->first();

        $units = [
            Bog::purchaseUnit($transaction->price * 100, $transaction->currency),
        ];

        $items = [
            Bog::purchaseItem($transaction->plan->id, $transaction->plan->price * 1000, 1, $transaction->plan->description),
        ];

        $response = Bog::checkout(Intent::Capture, $transaction->id, $units, $items);


        if (isset($response->status) && $response->status === CheckoutStatus::Created) {
            $transaction->update(['transaction_hash' => $response->payment_hash, 'transaction_order_id' => $response->order_id]);
            return Bog::redirect($response);
        }

        return back();
    }


    /**
     * Payment Success Callback
     */
    public function callback(Request $request)
    {
        $transaction = PaymentsIPay::where('transaction_hash', $request->input('payment_hash'));
        if ($transaction->exists()) {
            $transaction->update([
                'transaction_payment_id' => $request->input('ipay_payment_id'),
                'transaction_payment_method' => $request->input('payment_method'),
                'transaction_card_type' => $request->input('card_type'),
                'transaction_pan' => $request->input('pan'),
                'gc_transaction_id' => $request->input('transaction_id'),
                'status' => strtoupper($request->input('status')),
            ]);
            if ($request->input('status') == 'success') {
                IPayPaymentProcessed::dispatch($transaction->first());
            }
        } else {
            abort(419);
        }
    }
}
