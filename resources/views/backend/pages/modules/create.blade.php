@extends('backend.layouts.app')

@section('title', __('Create Module'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Create Module')
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/courses/module/store') }}" method="POST">
                        @csrf

                        @if(request()->filled('id'))
                            <input type="hidden" name="course_id" value="{{ request()->id }}">
                        @else
                            <div class="form-group">
                                <select name="course_id" class="form-control">
                                    @foreach(\App\Models\Course::all() as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Module Name">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Module Details" rows="10"></textarea>
                        </div>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}

                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-block">Create</button>
                            <a href="{{ url()->previous() }}" class="btn btn-link btn-block">Cancel Edit</a>
                        </div>

                    </form>

                </div><!--col-md-10-->
            </div><!--row-->
        </div>
    </div>
@endsection