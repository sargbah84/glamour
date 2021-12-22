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
        <div class="clearfix mb-3">
            <h5><span class="mt-3">Plans</span> <a href="{{ url('admin/plans/create') }}" class="btn btn-primary float-right">Add a Plan</a></h5>
        </div>
        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-md-4" style="opacity: {{ $plan->is_active == 1 ? 1 : '0.5' }}">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $plan->name }} <a href="{{ url('admin/plans/edit/' . $plan->slug) }}" class="btn btn-light py-0 float-right">Edit</a></h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $plan->description }}</p>
                            <p class="mb-0">{{ $plan->is_active == 1 ? $plan->price .' '. $plan->currency : 'Plan Inactive' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($plans->count() < 3)
                @for ($i = 0; $i < 3 - $plans->count(); $i++)
                    <div class="col-md-4">
                        <div class="border" style="height: 200px;">
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
@endsection
