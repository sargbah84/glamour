@extends('frontend.layouts.app')

@section('title', __('My Plans'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="clearfix p-3 mb-4 shadow-sm">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/300" class="img-fluid" alt="Pro Plan" class="src">
                        </div>
                        <div class="col-md-8">
                            <h4>Pro Plan</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde quisquam maiores consectetur laudantium? Ad amet eius quam qui nisi cumque possimus eum voluptatem rem corrupti dolores ullam.</p>
                            <a href="#" class="btn btn-primary rounded disabled">Change Plan</a>
                        </div>
                    </div>
                </div>
                @if($logged_in_user->isUser())
                    <div class="clearfix p-3 mb-4 shadow-sm">
                        <h4>Billing</h4>
                        <table class="table">
                            <tr>
                                <td width="20%">Name:</td>
                                <td>{{ $logged_in_user->firstname .' '. $logged_in_user->lastname }}</td>
                            </tr>
                            <tr>
                                <td width="20%">Address:</td>
                                <td>
                                    213 Street Address<br/>
                                    City Name
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Card:</td>
                                <td>**** **** **** 3422 - <a href="#change_card">Change Card</a></td>
                            </tr>
                        </table>
                    </div>

                    <div class="clearfix bg-white p-4 shadow-sm d-none animate__animated" id="card-wrapper">
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block rounded">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix w-75 mx-auto my-4">
                        <a href="{{ url('account') }}" class="btn btn-light btn-block rounded">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Back to Account') }}
                        </a>
                    </div>

                @endif
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection

@push('after-scripts')
    <script>
        $('a[href="#change_card"]').on('click', function(){
            $('#card-wrapper').addClass('animate__fadeIn').toggleClass('d-none');
        });
    </script>
@endpush