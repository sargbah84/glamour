<?php

namespace App\Payments\Providers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TBCPayment;
use App\Payments\Contracts\Provider;
use WeAreDe\TbcPay\TbcPayProcessor;

class TBC extends AbstractProvider implements Provider
{

    protected $client;


    public function __construct(array $config)
    {
        parent::__construct($config);
    }


    /**
     * Payment redirect method
     *
     * @param Order $order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function redirect(Order $order)
    {
        $payment = new TbcPayProcessor(storage_path("/tbc/catproducts.pem"), 'GHluir67to76rkhtMHyrted',
            request()->ip());

        $productsPrice = $itemsPrice = $order->items->sum(function (OrderItem $item) {
            return $item->price * $item->quantity;
        });

        $commission = $order->commission_type == "static" ? $order->bank_commission : ($productsPrice * $order->bank_commission / 100);

        $payment->amount      = ($productsPrice + $commission + $order->delivery_price) * 100;
        $payment->currency    = 981;
        $payment->description = "შეკვეთა #{$order->id}";
        $payment->language    = 'GE';

        //$start = $payment->dms_start_authorization();
        $start = $payment->sms_start_transaction();

        if (isset($start['TRANSACTION_ID']) && ! isset($start['error'])) {
            $trans_id = $start['TRANSACTION_ID'];

            TBCPayment::create(['trans_id' => $start['TRANSACTION_ID'], 'order_id' => $order->id]);

            return view('cat.pages.payments.tbc_redirect', compact('trans_id'));
        }

        return redirect('/');
    }


    /**
     * Payment Success Callback
     */
    public function callback()
    {
        $payment = new TbcPayProcessor(storage_path("/tbc/catproducts.pem"), 'GHluir67to76rkhtMHyrted',
            request()->ip());

        if (request()->has('trans_id')) {
            $trans_id   = str_replace(' ', '+', request('trans_id'));
            $result     = $payment->get_transaction_result($trans_id);
            $tbcPayment = TBCPayment::where('trans_id', $trans_id)->first();
            if ($tbcPayment) {
                $tbcPayment->fill(['status' => $result['RESULT'], 'details' => $result])->save();
                if ($result['RESULT'] == "OK" && $tbcPayment->order->status == "pending") {
                    $tbcPayment->order->status = 'success';
                    $tbcPayment->order->save();
                } elseif ($result['RESULT'] == "FAILED" && $tbcPayment->order->status == "pending") {
                    $tbcPayment->order->status = 'failed';
                    $tbcPayment->order->save();
                } elseif ($result['RESULT'] == "TIMEOUT" && $tbcPayment->order->status == "pending") {
                    $tbcPayment->order->status = 'canceled';
                    $tbcPayment->order->save();
                }
            }
        }

        return redirect(action('ProfileController@orders'));
    }

    /*

    public function refund(Order $order)
    {
        $payment    = new TbcPayProcessor(storage_path("/tbc/catproducts.pem"), 'GHluir67to76rkhtMHyrted', request()->ip());
        $tbcPayment = TBCPayment::where('order_id', $order->id)->first();

        $payment->refund_transaction($tbcPayment->trans_id);

    }


    public function approve(Order $order)
    {
        $payment    = new TbcPayProcessor(storage_path("/tbc/catproducts.pem"), 'GHluir67to76rkhtMHyrted', request()->ip());
        $tbcPayment = TBCPayment::where('order_id', $order->id)->first();

        $payment->dms_make_transaction($tbcPayment->trans_id);

    }
    */

}