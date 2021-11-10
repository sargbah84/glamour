@extends('backend.layouts.app')

@section('title', _('Update Lesson'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Update Lesson')
            <a href="{{ url('admin/courses/lesson/delete/'. $lesson->id) }}" class="btn btn-danger delete-item float-right">@lang('Delete Course')</a>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/courses/lesson/update/'. $lesson->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select name="module_id" class="form-control">
                                @foreach(\App\Models\Module::where('course_id', $lesson->module->course->id)->get() as $module)
                                    <option value="{{ $module->id }}" {{ ($lesson->module_id == $module->id) ? 'selected' : '' }}>{{ $module->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Lesson Name" value="{{ $lesson->name }}">
                        </div>

                        <div class="form-group">
                            <input type="text" name="video_url" class="form-control" placeholder="Video Url" value="{{ $lesson->video_url }}" required>
                        </div>

                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Lesson Details" rows="10">{{ $lesson->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="duration" class="form-control" placeholder="Duration" value="{{ $lesson->duration }}" required>
                        </div>

                        <iframe src="" frameborder="0" style="display:none"></iframe>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}

                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-block">@lang('Update Lesson')</button>
                            <a href="{{ url('admin/courses/details/' . $module->course->slug) }}" class="btn btn-link btn-block">@lang('Cancel Edit')</a>
                        </div>

                    </form>

                </div><!--col-md-10-->
            </div><!--row-->
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="https://player.vimeo.com/api/player.js"></script>
        <script>
            $('input[name=video_url]').on('input', function(){
                var video_duration = 0;
                var iframe = document.querySelector('iframe');
                $('iframe').attr('src', $(this).val());
                setTimeout(function(){
                    var player = new Vimeo.Player(iframe);
                    player.getDuration().then(function(duration){
                        $('input[name=duration]').val(duration);
                    });
                }, 100);
            });
    </script>
@endpush