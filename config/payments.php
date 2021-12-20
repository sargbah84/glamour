<?php
return [

    'default_driver' => 'IPay',

    'gateways' => [
        'unipay' => [
            /**
             * Merchant ID provided by UniPay
             */
            'merchantId' => env('UNIPAY_MERCHANT_ID'),

            /**
             * Secret key provided by UniPay
             */
            'secretKey' => env('UNIPAY_SECRET_KEY'),

            /**
             * Callback url where will be redirected after a success/failure payment
             */
            'redirect_url' => env('UNIPAY_REDIRECT_URL', '/payments/redirect'),

            /**
             * Payment url from UniPay
             */
            'url' => env('UNIPAY_URL', 'https://apiv2.unipay.com'),

            /**
             * Checkout url from UniPay
             */
            'checkout_url' => env('UNIPAY_CHECKOUT_URL', 'custom/checkout/v1/createorder'),
        ],
        'ipay' => [],
    ]
];
