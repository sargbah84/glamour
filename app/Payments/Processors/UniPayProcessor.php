<?php

namespace App\Payments\Processors;

use Illuminate\Http\Request;

class UniPayProcessor
{

    /**
     * error codes
     */
    public static array $ERROR = [
        'OK' => 0,
        'HTTP_AUTORIZATION_MERCHANT_ID_WRONG' => 403,
        'HTTP_AUTORIZATION_MERCHANT_NOT_DEFINED' => 402,
        'HTTP_AUTORIZATION_HASH_WRONG' => 401,
        'ERROR_MERCHANT_IS_DISABLED' => 101,
        'ERROR_MERCHANT_ID_NOT_DEFINED' => 102,
        'ERROR_MERCHANT_ORDER_ID_NOT_DEFINED' => 103,
        'ERROR_ORDER_PRICE_NOT_DEFINED' => 104,
        'ERROR_ORDER_CURRENCY_NOT_DEFINED' => 105,
        'ERROR_ORDER_CURRENCY_BAT_FORMAT' => 106,
        'ERROR_LANGUAGE_BAD_FORMAT' => 107,
        'ERROR_MIN_AMOUNT' => 108,
        'ERROR_MAX_AMOUNT' => 109,
        'ERROR_HASH' => 110,
        'ERROR_BAD_FORMAT_OF_BACKLINKS' => 111,
        'ERROR_BAD_FORMAT_OF_LOGO' => 112,
        'INSUFFICIENT_FUNDS' => 140,
        'AMOUNT_LIMIT_EXCEEDED' => 141,
        'FREQUENCY_LIMIT_EXCEEDED' => 142,
        'CARD_NOR_EFFECTIVE' => 143,
        'CARD_EXPIRED' => 144,
        'CARD_LOST' => 145,
        'CARD_STOLEN' => 146,
        'CARD_RESTRICTED' => 147,
        'DECLINED_BY_ISSUER' => 148,
        'BANK_SYSTEM_ERROR' => 149,
        'UNKNOWN' => 150,
        'AUTHENTICATION_FAILED' => 151,
        'OFFER_TIMEOUT' => 152,
    ];

    /**
     * Status codes
     */
    public static array $STATUS = [
        1 => 'PROCESS',
        2 => 'HOLD',
        3 => 'SUCCESS',
        5 => 'REFUNDED',
        13 => 'FAILED',
        19 => 'PARTIAL_REFUNDED',
        22 => 'INCOMPLETE_BANK',
        23 => 'INCOMPLETE',
        1000 => 'CREATED',
        1001 => 'PROCESSING',
    ];

    /**
     * gateway endpoint
     *
     * @var string
     */
    private string $url;

    /**
     * credentials merchant Id
     *
     * @var string
     */
    private string $merchantId;

    /**
     * credentials secret key
     *
     * @var string
     */
    private string $secretKey;

    /**
     * transaction amount in fractional units, mandatory (up to 12 digits)
     * 100 = 1 unit of currency. e.g. 1 gel = 100.
     *
     * @var integer
     */
    public int $amount;


    public function __construct()
    {
        $this->url = config('payments.gateways.unipay.url');
        $this->merchantId = config('payments.gateways.unipay.merchantId');
        $this->secretKey = config('payments.gateways.unipay.secretKey');
    }


    /**
     * Curl is responsible for sending data to remote server, using certificate for ssl connection
     *
     * @param string $additionalURL additional URL after base url
     * @param string $queryString created from an array using method build_query_string
     *
     * @return string returns tbc server response in the form of key: value \n key: value. OR error: value.
     */
    private function curl(string $additionalURL, string $queryString): string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POSTFIELDS, $queryString);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->url . '/' . $additionalURL);

        return curl_exec($curl);
    }


    /**
     * Takes array and transforms into a POST string
     * curls it to tbc server
     * parses results
     * returns parsed results
     *
     * @param string $additionalURL
     * @param array $postFields
     *
     * @return mixed
     */
    private function process(string $additionalURL, array $postFields)
    {
        $postFields = json_encode($postFields);
        $result = $this->curl($additionalURL, $postFields);
        return json_decode($result);
    }


    /**
     * @param array $request
     * @param string $except
     * @return string
     */
    private function calculateHashPost(array $request, string $except = ''): string
    {
        $request = collect($request);
        $hashString = $this->secretKey . '|' . implode('|', $request->except($except)->toArray());

        return hash('sha256', $hashString);
    }


    /**
     * @param array $request
     * @param string $except
     * @return string
     */
    private function calculateHashCallback(array $request, string $except = ''): string
    {
        $hashString = implode('|', $request) . '|' . $this->secretKey;

        return hash('sha256', $hashString);
    }


    /**
     * Create Order for further procession
     *
     * @param array $uniPayOrder
     *
     * String MerchantUser - Clients Identification Account in Merchant System
     * String MerchantOrderID - Merchant Transaction Number
     * Int OrderPrice - Order Total Price in Tetri’s
     * Int Discount - Order Discount Amount Price in Tetri’s
     * Int Shipping - Order Shipping Amount Price in Tetri’s
     * String OrderCurrency - GEL, USD, EUR Defoult currency is Georgian Lari
     * String OrderName - Test Order Name
     * String OrderDescription - Test Order Description
     * Info []Items - List of Products, Items are passed as string with delimiters
     * String BackLink - Merchant Back Link URL encoded in based64
     * String Mlogo - Merchant’s Logo URL URL encoded in based64
     * String Mslogan - Merchant’s Slogan TEXT Some Simple Site Slogan
     * String Language - GE – Georgia, EN- English,
     *
     *
     *
     * TRANSACTION_ID - transaction identifier (28 characters in base64 encoding)
     * error          - in case of an error
     */
    public function createOrder(array $uniPayOrder)
    {
        $additionalURL = 'custom/checkout/v1/createorder';

        $uniPayOrder = ['MerchantID' => $this->merchantId] + $uniPayOrder;

        $uniPayOrder['Hash'] = $this->calculateHashPost($uniPayOrder, 'Items');
        return $this->process($additionalURL, $uniPayOrder);
    }


    /**
     * @param array $request
     * @return bool
     */
    public function validateCallback(Request $request): bool
    {
        $hashParams = $request->only('UnipayOrderID', 'MerchantOrderID', 'Status');
        $hash = $this->calculateHashCallback($hashParams);

        return $hash == $request['Hash'];
    }
}
