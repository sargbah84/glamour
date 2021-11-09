@extends('frontend.layouts.app')

@section('title', __('Pricing Plans'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="clearfix bg-white p-3 mb-4 shadow-sm">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/300" class="img-fluid" alt="Pro Plan" class="src">
                        </div>
                        <div class="col-md-8">
                            <h4>Pro Plan</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde quisquam maiores consectetur laudantium? Ad amet eius quam qui nisi cumque possimus eum voluptatem rem corrupti dolores ullam.</p>
                            <button type="button" id="show_card" class="btn btn-primary rounded">Chose Plan</button>
                        </div>
                    </div>
                </div>
                
                <div class="clearfix bg-white p-4 mb-4 shadow-sm d-none animate__animated" id="card-wrapper">
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
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection

@push('after-scripts')
    <script>
        $('#show_card').on('click', function(){
            $('#card-wrapper').addClass('animate__fadeIn').toggleClass('d-none');
        });
    </script>
@endpush