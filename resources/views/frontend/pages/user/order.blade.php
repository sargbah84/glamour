@extends('frontend.layouts.app')

@section('title', __('My Plans'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="clearfix bg-white p-4 mb-4 shadow-sm">
                    <h4 class="pb-2">Order Details</h4>
                    <table class="table clearfix w-100 mb-0">
                        <thead class="font-weight-bold">
                            <tr>
                                <th>
                                    Item
                                </th>
                                <th class="text-right">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ __('Pro Plan - Monthly Subscription') }}
                                </td>
                                <td class="text-right">
                                    $00.00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix bg-white p-4 shadow-sm" id="card-wrapper">
                    <form action="#">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name on Card">
                        </div>
                        <div class="form-group">
                            <h5>Payment Method</h5>
                        </div>
                        <div class="form-group">
                            <input type="text" name="card" class="form-control" placeholder="Card Number">
                        </div>
                        <div class="form-group">
                            <input type="text" name="cvc" class="form-control" placeholder="CVC">
                        </div>
                        <div class="form-group">
                            <input type="text" name="exp" class="form-control" placeholder="MM/YYYY">
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block rounded">Place Order</button>
                        </div>
                    </form>
                </div>
                <div class="clearfix w-75 mx-auto my-4">
                    <a href="{{ url('plans') }}" class="text-danger d-inline-block py-1">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Cancel Order') }}
                    </a>
                </div>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection