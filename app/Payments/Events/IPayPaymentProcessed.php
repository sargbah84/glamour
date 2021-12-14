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
    public PaymentsIPay $IPayTransaction;

    /**
     * Create a new event instance.
     *
     * @param PaymentsIPay $IPayTransaction
     */
    public function __construct(PaymentsIPay $IPayTransaction)
    {
        $this->IPayTransaction = $IPayTransaction;
    }
}
