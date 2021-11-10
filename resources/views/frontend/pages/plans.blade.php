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
                            <h4 class="pt-2">Pro Plan</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde quisquam maiores consectetur laudantium? Ad amet eius quam qui nisi cumque possimus eum.</p>
                            <a href="{{ url('account/order') }}" class="btn btn-primary rounded">Chose Plan</a>
                        </div>
                    </div>                
                </div>

                <div class="clearfix w-75 mx-auto my-4">
                    <a href="{{ url('courses') }}" class="btn btn-light btn-block rounded">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Back to Courses') }}
                    </a>
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