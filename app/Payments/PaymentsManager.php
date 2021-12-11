<?php

namespace App\Payments;

use App\Payments\Contracts\Factory;
use App\Payments\Providers\TBC;
use App\Payments\Providers\TBCInstallment;
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
     * @return TBC
     */
    protected function createTBCDriver(): TBC
    {
        $config = $this->app['config']['services.payments.tbc'] ?? [];

        return $this->buildProvider('App\Payments\Providers\TBC', $config);
    }


    /**
     * Create an instance of the specified driver.
     *
     * @return UniPay
     */
    protected function createUniPayDriver(): UniPay
    {
        $config = $this->app['config']['services.payments.uniPay'] ?? [];

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
