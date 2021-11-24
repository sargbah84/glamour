@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="clearfix p-4">
                    <div class="clearfix text-center mb-4">
                        <h2>@lang('Register')</h2>
                    </div>

                    <div class="clearfix">
                        <x-forms.post :action="route('frontend.auth.register')" class="validate">
                            <div class="form-group">
                                <label for="firstname" class="form-label d-none">@lang('First Name')</label>

                                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="{{ __('First Name') }}" maxlength="100" required autofocus autocomplete="firstname" />
                            </div><!--form-group-->

                            <div class="form-group">
                                <label for="lastname" class="form-label d-none">@lang('Last Name')</label>

                                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}" placeholder="{{ __('Last Name') }}" maxlength="100" required autofocus autocomplete="lastname" />
                            </div><!--form-group-->

                            <div class="form-group">
                                <label for="name" class="form-label d-none">@lang('E-mail Address')</label>

                                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autocomplete="email" />
                            </div><!--form-group-->

                            <div class="form-group">
                                <label for="name" class="form-label d-none">@lang('Password')</label>

                                <input type="password" name="password" id="password" class="form-control passwordField" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" />
                            </div><!--form-group-->

                            <div class="form-group">
                                <label for="name" class="form-label d-none">@lang('Password Confirmation')</label>

                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control passwordField" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                                <small class="form-text text-info ml-2 text-decoration-underline cursor-pointer" id="revealPass"><span>@lang('Show')</span> @lang('Password')</small>
                            </div><!--form-group-->

                            <div class="form-group">
                                <div class="alert alert-primary" role="alert">
                                    <span class="font-weight-bold">Note:</span> Please make sure that your password meet these requirements: 
                                    <ul>
                                        <li>Password must be at least 8 characters long</li>
                                        <li>Contain at least one uppercase letter</li>
                                        <li>Contain at least one lowercase letter</li> 
                                        <li>Contains at least a number</li> 
                                        <li>And one special characters such as <br/>$ # @ * & %.</li>
                                    </ul>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input" required>
                                    <label class="form-check-label" for="terms">
                                        @lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a>
                                    </label>
                                </div>
                            </div><!--form-group-->

                            @if(config('global.access.captcha.registration'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        <input type="hidden" name="captcha_status" value="true" />
                                    </div><!--col-->
                                </div><!--row-->
                            @endif

                            <input type="hidden" name="email_verified" value="1">

                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" type="submit">@lang('Register')</button>
                            </div><!--form-group-->

                            <div class="form-group text-center">
                                <span>@lang('I already have an account') </span><x-utils.link :href="route('frontend.auth.login')" class="btn btn-link" :text="__('Sign In')" />
                            </div><!--form-group-->

                        </x-forms.post>
                    </div>
                </div>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection