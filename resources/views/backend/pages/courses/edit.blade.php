@extends('backend.layouts.app')

@section('title', _('Create Course'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Create Course')
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/courses/update/'. $course->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="@lang('Course Name')" value="{{ $course->name }}">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="@lang('Course Details')" rows="10">{{ $course->description }}</textarea>
                        </div>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}

                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-block">@lang('Update Course')</button>
                            <a href="{{ url()->previous() }}" class="btn btn-link btn-block">@lang('Cancel Edit')</a>
                        </div>

                    </form>

                </div><!--col-md-10-->
            </div><!--row-->
        </div>
    </div>
@endsection