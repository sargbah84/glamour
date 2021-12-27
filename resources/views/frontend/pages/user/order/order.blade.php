@extends('frontend.layouts.app')

@section('title', __('My Plans'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-7">

                @if($logged_in_user && (! $logged_in_user->isUser()))
                    <div class="alert alert-danger text-center pt-2 pb-2">
                        @lang("The form is disabled for admin users.")
                    </div><!--alert alert-warning-->
                @endif

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
                                {{$plan->name}} - {{__('Monthly Subscription')}}
                            </td>
                            <td class="text-right">
                                {{$plan->price}} ₾
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-justify">{{$plan->description}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('frontend.user.account.order.pay',$plan->slug) }}" class="validate"
                          method="POST">
                        @csrf
                        @if(auth()->user()->subscribedTo($plan->id))
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" name="payment_gateway" class="custom-control-input" value="ipay" checked>
                                <label class="custom-control-label" for="huey">Ipay</label>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block rounded {{ (! $logged_in_user->isUser()) ? 'disabled' : '' }}">Renew Subscription</button>
                            </div>
                        @else
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" name="payment_gateway" class="custom-control-input" id="ipay" value="ipay" checked>
                                <label class="custom-control-label" for="ipay">Ipay</label>
                            </div>
                            <div class="custom-control custom-radio mb-4">
                                <input type="radio" name="payment_gateway" class="custom-control-input" id="unipay" value="unipay">
                                <label class="custom-control-label" for="unipay">UniPay</label>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block rounded {{ (! $logged_in_user->isUser()) ? 'disabled' : '' }}">Place Order</button>
                            </div>
                        @endif
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
