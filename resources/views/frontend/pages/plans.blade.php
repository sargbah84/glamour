@extends('frontend.layouts.app')

@section('title', __('Pricing Plans'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-7">

                @if($logged_in_user && (!$logged_in_user->isUser()))
                    <div class="alert alert-danger text-center pt-2 pb-2">
                        @lang("The form is disabled for admin users.")
                    </div><!--alert alert-warning-->
                @endif

                @foreach($plans as $plan)
                    <div class="clearfix bg-white p-3 mb-4 shadow-sm" style="opacity: {{ ($logged_in_user->isUser()) ? 1 : '.6' }}">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300" class="img-fluid" alt="Pro Plan" class="src">
                            </div>
                            <div class="col-md-8">
                                <h4 class="pt-2">{{$plan->name}}</h4>
                                <p>{{$plan->description}}</p>
                                @if($logged_in_user)
                                    <a href="{{ route('frontend.user.account.order',$plan->slug) }}" class="btn btn-primary rounded {{ (!$logged_in_user->isUser()) ? 'disabled' : '' }}">
                                        {{ ($logged_in_user->hasActiveSubscription() && $logged_in_user->userSubscriptionName() == $plan->slug ) ? 'Renew Subscription' : 'Chose Plan' }}
                                    </a>
                                @else
                                    <a href="{{ route('frontend.user.account.order',$plan->slug) }}" class="btn btn-primary rounded">
                                        Chose Plan
                                    </a>
                                @endif
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
