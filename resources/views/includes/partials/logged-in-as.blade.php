@if($logged_in_user && $logged_in_user->isUser())
    @if(!$logged_in_user->hasActiveSubscription())
    <div class="alert alert-danger text-center pt-3 pb-3 mb-0">
        @lang('You do not have an active subscription. ') <a href="{{ route('frontend.pages.plans') }}" class="text-dark">@lang('Click here to subscribe')</a>.
    </div><!--alert alert-warning-->
    @endif
@endif

@impersonating
    <div class="alert alert-info position-fixed fixed-bottom text-center pt-3 pb-3 mb-0">
        @lang('You are currently logged in as :name.', ['name' => $logged_in_user->firstname]) <a href="{{ route('impersonate.leave') }}">@lang('Return to your account')</a>.
    </div><!--alert alert-warning-->
@endImpersonating
