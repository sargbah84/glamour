<?php

namespace App\Payments;

use App\Payments\Contracts\Factory;
use App\Payments\Providers\IPay;
use App\Payments\Providers\UniPay;
use Illuminate\Support\Manager;

class PaymentsManager extends Manager implements Factory
{

    /**
     * Get a driver instance.
     *
     * @param string $driver
     *
     * @return mixed
     */
    public function with(string $driver)
    {
        return $this->driver($driver);
    }


    /**
     * Get the default driver name.
     *
     * @return string
     * @throws \InvalidArgumentException
     *
     */
    public function getDefaultDriver(): string
    {
        return config('payments.default_driver');
    }


    /**
     * Create an instance of the specified driver.
     *
     * @return IPay
     */
    protected function createIPayDriver(): IPay
    {
        $config = $this->app['config']['payments.gateway.ipay'] ?? [];

        return $this->buildProvider('App\Payments\Providers\IPay', $config);
    }


    /**
     * Create an instance of the specified driver.
     *
     * @return UniPay
     */
    protected function createUniPayDriver(): UniPay
    {
        $config = $this->app['config']['payments.gateway.uniPay'] ?? [];

        return $this->buildProvider('App\Payments\Providers\UniPay', $config);
    }


    /**
     * Build an Sms provider instance.
     *q
     * @param string $provider
     * @param array $config
     *
     * @return mixed
     */
    public function buildProvider(string $provider, array $config)
    {
        return new $provider($config);
    }
}
