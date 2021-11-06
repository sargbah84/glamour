@if(isset($errors) && $errors->any())
    <x-utils.alert type="danger" class="header-message text-center">
        @foreach($errors->all() as $error)
            {{ $error }}<br/>
        @endforeach
    </x-utils.alert>
@endif

@if(session()->get('flash_success'))
    <x-utils.alert type="success" class="header-message text-center">
        {{ session()->get('flash_success') }}
    </x-utils.alert>
@endif

@if(session()->get('flash_warning'))
    <x-utils.alert type="warning" class="header-message text-center">
        {{ session()->get('flash_warning') }}
    </x-utils.alert>
@endif

@if(session()->get('flash_info') || session()->get('flash_message'))
    <x-utils.alert type="info" class="header-message text-center">
        {{ session()->get('flash_info') }}
    </x-utils.alert>
@endif

@if(session()->get('flash_danger'))
    <x-utils.alert type="danger" class="header-message text-center">
        {{ session()->get('flash_danger') }}
    </x-utils.alert>
@endif

@if(session()->get('status'))
    <x-utils.alert type="success" class="header-message text-center">
        {{ session()->get('status') }}
    </x-utils.alert>
@endif

@if(session()->get('resent'))
    <x-utils.alert type="success" class="header-message text-center">
        @lang('A fresh verification link has been sent to your email address.')
    </x-utils.alert>
@endif

@if(session()->get('verified'))
    <x-utils.alert type="success" class="header-message text-center">
        @lang('Thank you for verifying your e-mail address.')
    </x-utils.alert>
@endif
