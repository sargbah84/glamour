@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Courses')
            <a href="{{ url('admin/courses/create') }}" class="btn btn-light float-right">@lang('Create Course')</a>
        </x-slot>

        <x-slot name="body">
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang('ID')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Lessons')</th>
                        <th>@lang('Date Created')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                @foreach($courses as $course)
                    <tbody>
                        <tr>
                            <td><img src="{{ $course->preview() }}" width="40px" alt=""></td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->lessons->count() }}</td>
                            <td>{{ $course->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-primary">@lang('Edit')</a>
                                <a href="{{ route('admin.courses.details', $course) }}" class="btn btn-sm btn-info">@lang('Details')</a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </x-slot>
    </x-backend.card>
@endsection
