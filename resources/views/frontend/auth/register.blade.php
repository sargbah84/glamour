@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Register')
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.register')">
                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">@lang('First Name')</label>

                                <div class="col-md-6">
                                    <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="{{ __('First Name') }}" maxlength="100" required autofocus autocomplete="firstname" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">@lang('Last Name')</label>

                                <div class="col-md-6">
                                    <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}" placeholder="{{ __('Last Name') }}" maxlength="100" required autofocus autocomplete="lastname" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('E-mail Address')</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>

                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control passwordField" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Password Confirmation')</label>

                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control passwordField" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                                    <small class="form-text text-info ml-2 text-decoration-underline cursor-pointer" id="revealPass"><span>@lang('Show')</span> @lang('Password')</small>
                                </div>
                            </div><!--form-group-->

                            <div class="row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="alert alert-primary" role="alert">
                                        Please make sure that your password meet these requirements: 
                                        <ul>
                                            <li>Password must be at least 8 characters long</li>
                                            <li>Contain at least one uppercase letter</li>
                                            <li>Contain at least one lowercase letter</li> 
                                            <li>Contains at least a number</li> 
                                            <li>And one special characters such as $ # @ * & %.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input" required>
                                        <label class="form-check-label" for="terms">
                                            @lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a>
                                        </label>
                                    </div>
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Register')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection