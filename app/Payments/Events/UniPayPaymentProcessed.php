<?php

namespace App\Payments\Events;

use App\Payments\Facades\Payment;
use App\Payments\Models\PaymentsUniPay;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UniPayPaymentProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    public PaymentsUniPay $uniPayTransaction;

    /**
     * Create a new event instance.
     *
     * @param PaymentsUniPay $uniPayTransaction
     */
    public function __construct(PaymentsUniPay $uniPayTransaction)
    {
        $this->uniPayTransaction = $uniPayTransaction;
    }
}
