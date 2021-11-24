@extends('backend.layouts.app')

@section('title', _('Course'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Course')
            <a href="{{ url('admin/courses/delete/'. $course->id) }}" class="btn btn-danger {{ ($course->modules->count() > 0) ? 'disabled' : '' }} delete-item float-right">@lang('Delete Course')</a>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ url('admin/courses/edit/'. $course->id) }}">
                                <img src="{{ $course->preview() }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <h3 class="my-2">{{ $course->name }}</h3>
                            <p>{{ $course->description ?? "Some quick example text to build on the card title and make up the bulk of the card's content." }}</p>
                            <a href="{{ url('admin/courses/edit/' . $course->id) }}" class="btn btn-primary">
                            @lang('Edit Course')
                            </a>
                        </div>
                    </div>
                    <div class="clearfix my-4">
                        @forelse($course->modules as $module)
                            <ul class="list-group mt-3">
                                <li class="list-group-item active">
                                    {{ $module->name }}
                                    <a href="{{ url('admin/courses/module/edit/' . $module->id) }}" class="text-white float-right">Edit Module</a>
                                </li>
                                <div class="list-group">
                                    @forelse($module->lessons as $lesson)
                                        <a href="{{ url('admin/courses/lesson/edit/' . $lesson->id) }}" class="list-group-item list-group-item-action">
                                            {{ $lesson->name }} <span class="float-right">@lang('Details')</span>
                                        </a>
                                    @empty
                                        <p class="text-center text-muted py-4">@lang('Course does not have lessons yet.') <a href="{{ url('admin/courses/lesson/create?id=' . $module->id) }}">@lang('Add Lesson')</a></p>
                                    @endforelse
                                    @if($module->lessons->count() > 0)
                                        <a href="{{ url('admin/courses/lesson/create?id=' . $module->id) }}" class="p-1">@lang('Add Lesson')</a>
                                    @endif
                                </div>
                            </ul>
                        @empty
                            <p class="text-center text-muted py-4">@lang('Course does not have lessons yet.') <a href="{{ url('admin/courses/module/create?id=' . $course->id) }}">Add Module</a></p>
                        @endforelse

                        @if($course->modules->count() > 1)
                            <a href="{{ url('admin/courses/module/create?id=' . $course->id) }}" class="btn btn-primary mt-2">@lang('New Module')</a>
                        @endif

                    </div>

                    <div class="clearfix">
                        <div class="text-center w-75 mx-auto">
                            <a href="{{ url('/admin/courses') }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-arrow-left"></i>
                                @lang('Back to Courses')
                            </a>
                        </div>
                    </div>

                </div><!--col-md-10-->
            </div><!--row-->

        </div>
    </div>
@endsection