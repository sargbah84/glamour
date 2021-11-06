@impersonating
    <div class="alert alert-info text-center pt-1 pb-1 mb-0">
        @lang('You are currently logged in as :name.', ['name' => $logged_in_user->firstname]) <a href="{{ route('impersonate.leave') }}">@lang('Return to your account')</a>.
    </div><!--alert alert-warning-->
@endImpersonating
