<?php
namespace App\Payments\Contracts;

interface Factory
{

    /**
     * Get an Sms provider implementation.
     *
     * @param  string $driver
     *
     * @return \App\Payments\Contracts\Provider
     */
    public function driver($driver = null);
}