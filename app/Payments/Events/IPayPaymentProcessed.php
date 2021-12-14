<?php

namespace App\Payments\Events;

use App\Payments\Models\PaymentsIPay;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IPayPaymentProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var PaymentsIPay
     */
    public PaymentsIPay $transaction;

    /**
     * Create a new event instance.
     *
     * @param PaymentsIPay $transaction
     */
    public function __construct(PaymentsIPay $transaction)
    {
        $this->transaction = $transaction;
    }
}
