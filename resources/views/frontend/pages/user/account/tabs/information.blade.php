<x-forms.patch :action="route('frontend.user.profile.update')">
    <div class="form-group row">
        <label for="firstname" class="col-md-3 col-form-label text-md-right">@lang('First Name')</label>

        <div class="col-md-9">
            <input type="text" name="firstname" class="form-control" placeholder="{{ __('First Name') }}" value="{{ old('firstname') ?? $logged_in_user->firstname }}" required autofocus autocomplete="firstname" />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="lastname" class="col-md-3 col-form-label text-md-right">@lang('Last Name')</label>

        <div class="col-md-9">
            <input type="text" name="lastname" class="form-control" placeholder="{{ __('Last Name') }}" value="{{ old('name') ?? $logged_in_user->lastname }}" required autofocus autocomplete="lastname" />
        </div>
    </div><!--form-group-->

    @if ($logged_in_user->canChangeEmail())
        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label text-md-right">@lang('E-mail Address')</label>

            <div class="col-md-9">
                <x-utils.alert type="info" class="mb-3" :dismissable="false">
                    <i class="fas fa-info-circle"></i> @lang('If you change your e-mail you will be logged out until you confirm your new e-mail address.')
                </x-utils.alert>

                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') ?? $logged_in_user->email }}" required autocomplete="email" />
            </div>
        </div><!--form-group-->
    @endif

    <div class="form-group row justify-content-center mb-0">
        <div class="col-md-7">
            <button class="btn btn-primary" type="submit">@lang('Update Profile')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
