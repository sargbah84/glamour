@extends('backend.layouts.app')

@section('title', __('Create Lesson'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Create Lesson')
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/courses/lesson/store') }}" method="POST">
                        @csrf

                        @if(request()->filled('id'))
                            <input type="hidden" name="module_id" value="{{ request()->get('id')}}">
                        @else
                            <div class="form-group">
                                <select name="module_id" class="form-control">
                                    @foreach(\App\Models\Module::all() as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Lesson Name">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Lesson Details" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="video_url" class="form-control" placeholder="Video Url" required>
                        </div>

                        <input type="hidden" name="duration" required>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}

                        <iframe src="" frameborder="0" style="display:none"></iframe>

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