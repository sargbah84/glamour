@extends('frontend.layouts.app')

@section('title', __('Pricing Plans'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-7">

                @foreach($plans as $plan)
                    <div class="clearfix bg-white p-3 mb-4 shadow-sm">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300" class="img-fluid" alt="Pro Plan" class="src">
                            </div>
                            <div class="col-md-8 text-{{ (request()->get('q') != $plan->slug ) ? '' : 'muted' }}">
                                <h4 class="pt-2">{{$plan->name}}</h4>
                                <p>{{$plan->description}}</p>
                                <a href="{{ route('frontend.user.account.order',$plan->slug) }}" class="btn btn-primary rounded {{ (request()->get('q') != $plan->slug ) ?: 'disabled' }}">
                                    {{ (request()->get('q') != $plan->slug ) ? 'Chose Plan' : 'This is your plan' }} <i class="fas fa-{{ (request()->get('q') != $plan->slug ) ? '' : 'lock' }}"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

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
        $('#show_card').on('click', function () {
            $('#card-wrapper').addClass('animate__fadeIn').toggleClass('d-none');
        });
    </script>
@endpush
