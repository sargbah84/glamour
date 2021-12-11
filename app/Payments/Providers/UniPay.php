<?php

namespace App\Payments\Providers;

use App\Payments\Contracts\Provider;
use App\Payments\Events\UniPayPaymentProcessed;
use App\Payments\Models\PaymentsUniPay;
use App\Payments\Processors\UniPayProcessor;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UniPay extends AbstractProvider implements Provider
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
        $processor = new UniPayProcessor(config('payments.gateways.unipay.merchantId'),
            config('payments.gateways.unipay.secretKey'));

        $transaction = PaymentsUniPay::with('user', 'plan')->where('id', $transaction)->first();

        $uniPayOrder = [
            'MerchantUser' => $transaction->user->email,
            'MerchantOrderID' => $transaction->id,
            'OrderPrice' => $transaction->price,
            'OrderCurrency' => $transaction->currency,
            'SuccessRedirectUrl' => 'http://glamour.local/account/order/pro-plan',
            'CancelRedirectUrl' => 'http://glamour.local/account/order/pro-plan',
            'CallBackUrl' => action('\App\Payments\Http\Controllers\PaymentsController@callback', ['provider' => 'unipay']),
            'Language' => 'EN',
            'OrderName' => $transaction->plan->name,
            'OrderDescription' => $transaction->plan->description,
        ];


        $response = $processor->createOrder($uniPayOrder);

        if ($response->errorcode == UniPayProcessor::$ERROR['OK']) {

            $transaction->update(['transaction_hash' => $response->data->UnipayOrderHashID]);
            $transaction->update(['transaction_order_id' => $response->data->UnipayOrderID]);

            return redirect($response->data->Checkout);

        }


        /**
         * Handle error response.
         */
        $transaction->update(['error' => $response->message, 'status' => UniPayProcessor::$STATUS[13]]);

        return back();
    }


    /**
     * Payment Success Callback
     */
    public function callback(Request $request)
    {
        $processor = new UniPayProcessor(config('payments.gateways.unipay.merchantId'),
            config('payments.gateways.unipay.secretKey'));

        if ($processor->validateCallback($request)) {

            $transaction = PaymentsUniPay::where('transaction_hash', $request->input('UnipayOrderID'));

            if ($transaction->exists()) {

                $transaction->update(['status' => UniPayProcessor::$STATUS[$request->input('Status')]]);

                if ($request->input('Status') == array_flip(UniPayProcessor::$STATUS)['SUCCESS']) {

                    UniPayPaymentProcessed::dispatch($transaction->first());
                }
            }
        }
    }
}
