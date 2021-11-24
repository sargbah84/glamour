@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="clearfix p-4">
                    <div class="clearfix text-center mb-3">
                        <h2>@lang('Login')</h2>
                    </div>

                    <div class="clearfix">
                        <x-forms.post :action="route('frontend.auth.login')" class="validate">
                            <div class="form-group">
                                <label for="email" class="col-form-label d-none">@lang('E-mail Address')</label>

                                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                            </div><!--form-group-->

                            <div class="form-group">
                                <label for="password" class="col-form-label d-none">@lang('Password')</label>

                                <input type="password" name="password" id="password" class="form-control passwordField" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                                <small class="form-text text-info ml-2 text-decoration-underline cursor-pointer" id="revealPass"><span>@lang('Show')</span> @lang('Password')</small>
                            </div><!--form-group-->

                            <div class="form-group">
                                <div class="form-check">
                                    <input name="remember" id="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} />

                                    <label class="form-check-label" for="remember">
                                        @lang('Remember Me')
                                    </label>
                                </div><!--form-check-->
                            </div><!--form-group-->

                            @if(config('global.access.captcha.login'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        <input type="hidden" name="captcha_status" value="true" />
                                    </div><!--col-->
                                </div><!--row-->
                            @endif

                            <div class="form-group mb-1">
                                <button class="btn btn-primary btn-block" type="submit">@lang('Login')</button>
                            </div><!--form-group-->

                            <div class="form-group text-center">
                                <x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-link" :text="__('Forgot Your Password?')" /> | 
                                <x-utils.link :href="route('frontend.auth.register')" class="btn btn-link" :text="__('Register')" />
                            </div><!--form-group-->

                            <div class="text-center">
                                @include('frontend.auth.includes.social')
                            </div>
                        </x-forms.post>
                    </div>
                </div>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection