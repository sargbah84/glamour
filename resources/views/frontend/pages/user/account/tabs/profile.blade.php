<div class="table-responsive">
    <table class="table mb-0">

        <tr>
            <th>@lang('Name')</th>
            <td>{{ $logged_in_user->firstname .' '. $logged_in_user->lastname }}</td>
        </tr>

        <tr>
            <th>@lang('E-mail Address')</th>
            <td>{{ $logged_in_user->email }}</td>
        </tr>

        @if ($logged_in_user->isSocial())
            <tr>
                <th>@lang('Social Provider')</th>
                <td>{{ ucfirst($logged_in_user->provider) }}</td>
            </tr>
        @endif

        <tr>
            <th>@lang('Timezone')</th>
            <td>{{ $logged_in_user->timezone ? str_replace('_', ' ', $logged_in_user->timezone) : __('N/A') }}</td>
        </tr>

        <tr>
            <th>@lang('Account Created')</th>
            <td>@displayDate($logged_in_user->created_at) ({{ $logged_in_user->created_at->diffForHumans() }})</td>
        </tr>
        @if($logged_in_user->isUser())
            <tr>
                <th>@lang('Subscription')</th>
                <td>{{ ($logged_in_user->hasActiveSubscription()) ? $logged_in_user->userSubscriptionDaysLeftString() : '0 days' }} left - <a href="{{ ($logged_in_user->hasActiveSubscription()) ? url('/plans' . '?q=' . $logged_in_user->userSubscriptionName()) : url('/plans') }}" class="text-danger">{{ ($logged_in_user->hasActiveSubscription()) ? $logged_in_user->userSubscriptionPlanName() : 'No Subscription' }}</a></td>
            </tr>

            <tr>
                <th>@lang('Status')</th>
                <td><span class="badge badge-{{ ($logged_in_user->hasActiveSubscription()) ? 'success' : 'danger' }} p-2">{{ ($logged_in_user->hasActiveSubscription()) ? 'Active' : 'Inactive' }}</span></td>
            </tr>
        @endif
    </table>
    @if($logged_in_user->isUser())
        <div class="clearfix w-75 my-4 mx-auto text-center">
            <button submit="button" class="btn btn-danger btn-block disabled">Deactivate Account</button>
        </div>
    @endif
</div><!--table-responsive-->
