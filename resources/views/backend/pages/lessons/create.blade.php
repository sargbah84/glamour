@extends('backend.layouts.app')

@section('title', _('Create Lesson'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Create Lesson')
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/courses/lesson/store') }}" class="validate" method="POST">
                        @csrf

                        @if(request()->filled('id'))
                            <input type="hidden" name="module_id" value="{{ request()->get('id')}}">
                        @else
                            <div class="form-group">
                                <select name="module_id" class="form-control" required>
                                    @foreach(\App\Models\Module::all() as $module)
                                        <option value="{{ $module->id }}" {{ (old('module_id') == $module->id) ? 'selected' : '' }}>{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="@lang('Lesson Name')" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <input type="text" name="video_url" class="form-control" placeholder="Video Url" value="{{ old('video_url') }}" required>
                        </div>

                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="@lang('Lesson Details')" rows="10" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="duration" class="form-control" placeholder="Video Duration" value="{{ old('duration') }}" required>
                        </div>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}

                        <iframe src="" frameborder="0" style="display:none"></iframe>

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