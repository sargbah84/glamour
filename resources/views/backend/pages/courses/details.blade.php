@extends('backend.layouts.app')

@section('title', __('Course'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Courses')
            <a href="{{ url('admin/courses/delete/'. $course->id) }}" class="btn btn-danger {{ ($course->modules->count() > 0) ? 'disabled' : '' }} delete-item float-right">Delete Couse</a>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ url('admin/courses/edit/'. $course->id) }}">
                                <img src="https://via.placeholder.com/640x460" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <h3 class="my-2">{{ $course->name }}</h3>
                            <p>{{ $course->description ?? "Some quick example text to build on the card title and make up the bulk of the card's content." }}</p>
                            <a href="{{ url('admin/courses/edit/' . $course->id) }}" class="btn btn-primary">
                                Edit Course
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
                                            {{ $lesson->name }} <span class="float-right">Details</span>
                                        </a>
                                    @empty
                                        <p class="text-center text-muted py-4">Course does not have lessons yet. <a href="{{ url('admin/courses/lesson/create?id=' . $module->id) }}">Add Lesson</a></p>
                                    @endforelse
                                    @if($module->lessons->count() > 0)
                                        <a href="{{ url('admin/courses/lesson/create?id=' . $module->id) }}" class="p-1">Add Lesson</a>
                                    @endif
                                </div>
                            </ul>
                        @empty
                            <p class="text-center text-muted py-4">Course does not have lessons yet. <a href="{{ url('admin/courses/module/create?id=' . $course->id) }}">Add Module</a></p>
                        @endforelse

                        @if($course->modules->count() > 1)
                            <a href="{{ url('admin/courses/module/create?id=' . $course->id) }}" class="btn btn-primary mt-2">New Module</a>
                        @endif

                    </div>

                    <div class="clearfix">
                        <div class="text-center w-75 mx-auto">
                            <a href="{{ url('/admin/courses') }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-arrow-left"></i>
                                {{ __('Back to Courses') }}
                            </a>
                        </div>
                    </div>

                </div><!--col-md-10-->
            </div><!--row-->

        </div>
    </div>
@endsection

@section('modals')
    @include('backend.pages.courses.modals.edit.course')
    @include('backend.pages.courses.modals.edit.lesson')
    @include('backend.pages.courses.modals.edit.module')
    @include('backend.pages.courses.modals.new.lesson')
    @include('backend.pages.courses.modals.new.module')
@endsection

@push('after-scripts')
    <script>
        $('#editLesson').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget).data('id');
            console.log('ready');

            $.ajax({
                url: '{{ url("admin/courses/lesson") }}/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#editLesson input[name=name]').val(data.name);
                    $('#editLesson textarea[name=description]').val(data.description);
                    $('#editLesson input[name=video_url]').val(data.video_url);
                }
            });
        });

        $('#editModule').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            console.log(id);

            $.ajax({
                url: '{{ url("admin/courses/module") }}/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    modal.find('.modal-body #name').val(data.name);
                    modal.find('.modal-body #description').val(data.description);
                    modal.find('.modal-body #slug').val(data.slug);
                }
            });
        });
    </script>
@endpush