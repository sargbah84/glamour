<footer class="c-footer">
    <div>
        <strong>
            @lang('Copyright') &copy; {{ date('Y') }}
            <x-utils.link href="{{ url('/') }}" target="_blank" :text="__(appName())" />
        </strong>

        @lang('All Rights Reserved')
    </div>
</footer>
