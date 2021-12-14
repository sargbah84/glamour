<?php

namespace App\Payments\Contracts;


use Illuminate\Http\Request;

interface Provider
{

    public function redirect($transaction);


    public function update($transaction);


    public function callback(Request $request);

    public function orderDetails($transaction);

}
