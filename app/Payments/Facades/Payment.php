<?php

namespace App\Payments\Facades;

use App\Payments\Contracts\Factory;
use Illuminate\Support\Facades\Facade;

/**
 * @see PaymentManager
 */
class Payment extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}