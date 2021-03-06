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
                    <form action="{{ url('admin/courses/store') }}" class="validate" method="POST">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Course Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Course Details" rows="10">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <textarea name="tags" id="tags" rows="2" placeholder="Eg. beauty, hair dressing, etc."></textarea>
                            <span class="help-text">Add tags seperating by common. Eg. beauty, hair dressing, etc</span>
                        </div>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}

                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-block">@lang('Create')</button>
                            <a href="{{ url()->previous() }}" class="btn btn-link btn-block">@lang('Cancel Edit')</a>
                        </div>

                    </form>

                </div><!--col-md-10-->
            </div><!--row-->
        </div>
    </div>
@endsection