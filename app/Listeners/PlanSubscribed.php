<?php

namespace App\Listeners;

use App\Payments\Events\IPayPaymentProcessed;
use App\Payments\Events\UniPayPaymentProcessed;

class PlanSubscribed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
        //TODO: this is a basic implementation of subscribe event. Need review when subscription will be developed
        $user = $event->transaction->user;
        $plan = $event->transaction->plan;
        switch (get_class($event)) {
            case IPayPaymentProcessed::class:
            case UniPayPaymentProcessed::class:
                //check if transaction was success
                if ($event->transaction->status == 'SUCCESS') {
                    //check if user is already subscribed to plan
                    if ($user->subscribedTo($plan->id)) {
                        //renew subscription
                        $user->subscription($plan->slug)->renew();
                    } else {
                        //create new subscription
                        $user->newSubscription($plan->slug, $plan);
                    }
                }
                break;
        }
    }
}
