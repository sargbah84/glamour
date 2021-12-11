<?php

namespace App\Payments\Providers;

use App\Payments\Contracts\Provider;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractProvider implements Provider
{

    /**
     * HTTP Client instance.
     *
     * @var Client
     */
    protected Client $httpClient;

    /**
     * custom parameters to be sent with the request.
     *
     * @var array
     */
    protected array $parameters = [];

    /**
     * provider configs.
     *
     * @var array
     */
    protected array $config = [];


    /**
     * Create a new provider instance.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }


    /**
     * Get instance of Guzzle HTTP client.
     *
     * @return Client
     */
    protected function getHttpClient(): Client
    {
        return $this->httpClient;
    }


    /**
     * @param $method
     * @param string $uri
     * @param array $parameters
     *
     * @return ResponseInterface
     *
     * @throws GuzzleException
     */
    protected function request($method, string $uri = '/', array $parameters = []): ResponseInterface
    {
        return $this->getHttpClient()->request($method, $this->config['api_url'] . $uri,
            ['form_params' => array_merge($this->parameters, $parameters)]);
    }


    /**
     * Set Guzzle HTTP client instance.
     *
     * @param Client $client
     *
     * @return $this
     */
    public function setHttpClient(Client $client): AbstractProvider
    {
        $this->httpClient = $client;

        return $this;
    }


    /**
     * Set the custom parameters of the request.
     *
     * @param array $parameters
     *
     * @return $this
     */
    public function with(array $parameters): AbstractProvider
    {
        $this->parameters = $parameters;

        return $this;
    }


    /**
     * @param $transaction
     * @return mixed
     */
    public function redirect($transaction)
    {
        throw new InvalidArgumentException('Driver Not Support Redirects.');
    }


    /**
     * @param $transaction
     * @return mixed
     */
    public function update($transaction)
    {
        throw new InvalidArgumentException('Driver Not Support Redirects.');
    }


    /**
     * @return mixed
     */
    public function callback(Request $request)
    {
        throw new InvalidArgumentException('Driver Not Support Callback Processing.');
    }

}
