@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->firstname])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-backend.card>

    <div class="clearfix">
        <h5>Plans</h5>
        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $plan->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $plan->description }}</p>
                            <p class="mb-0">{{ $plan->price .' '. $plan->currency }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
