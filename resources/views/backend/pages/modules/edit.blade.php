@extends('backend.layouts.app')

@section('title', _('Create Module'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Create Module')
            <a href="{{ url('admin/courses/module/delete/'. $module->id) }}" class="btn btn-danger {{ ($module->lessons->count() > 0) ? 'disabled' : '' }} delete-item float-right">@lang('Delete Module')</a>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/courses/module/update/' . $module->id) }}" method="POST">
                    
                        @csrf

                        <div class="form-group">
                            <select name="course_id" class="form-control">
                                @foreach(\App\Models\Course::all() as $course)
                                    <option value="{{ $course->id }}" {{ ($module->course->id == $course->id) ? 'selected' : '' }}>{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Module Name" value="{{ $module->name }}">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Module Details" rows="10">{{ $module->description }}</textarea>
                        </div>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}

                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-block">@lang('Update Module')</button>
                            <a href="{{ url('admin/courses/details/' . $module->course->slug) }}" class="btn btn-link btn-block">@lang('Cancel Edit')</a>
                        </div>

                    </form>

                </div><!--col-md-10-->
            </div><!--row-->
        </div>
    </div>
@endsection