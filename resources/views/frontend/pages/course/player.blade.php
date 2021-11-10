@extends('frontend.layouts.app')

@section('title', __($lesson->name))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="clearfix">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $lesson->video_url ?? 'https://player.vimeo.com/video/256470214?h=0a6898a592' }}" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-10">
                        <h3 class="mb-3 mt-1">{{ $lesson->name }}</h3>
                        <p class="mb-0">{{ $lesson->description ?? "Some quick example text to build on the card title and make up the bulk of the card's content." }}</p>
                    </div>
                    <div class="col-md-2 text-center">
                        @if($lesson->next())
                            <a href="{{ url('courses/lesson/'. $lesson->next()->slug) }}" class="btn btn-light btn-block">Next &rarr;</a>
                        @else
                            <a href="#" class="btn btn-light btn-block disabled">Finish</a>
                        @endif
                    </div>
                </div>

                <div class="clearfix mt-4">
                    @foreach($modules as $module)
                        <ul class="list-group mb-3">
                            @if($module->lessons->count() > 0)
                                <li class="list-group-item active">
                                    {{ $module->name }}
                                </li>
                            
                                <div class="list-group">
                                    @foreach($module->lessons as $lessonb)
                                        <a href="{{ url('/courses/lesson/' . $lessonb->slug) }}" class="list-group-item list-group-item-action {{ ($lesson->id == $lessonb->id || $lessonb->isWatched(auth()->user())) ? 'text-primary' : '' }}">
                                            {{ $lessonb->name }} 
                                        @if($lessonb->isWatched(auth()->user()))    
                                            <i class="fas fa-check text-primary float-right" style="font-size: 16px;"></i>
                                        @else
                                            <span class="float-right" style="width: 80px; padding-top: 10px;">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $lessonb->progress(auth()->user()) }}%" aria-valuenow="{{ $lessonb->progress(auth()->user()) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>  
                                            </span>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>
                            @endif
                        </ul>
                    @endforeach
                </div>

                <div class="clearfix">
                    <div class="text-center w-75 mx-auto">
                        <a href="{{ url('/courses/' . $lesson->module->course->slug) }}" class="btn btn-primary btn-block">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('Back to Course Details') }}
                        </a>
                    </div>
                </div>

            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection

@push('after-scripts')
    @if($logged_in_user->isUser())
        <script src="https://player.vimeo.com/api/player.js"></script>
        <script>
            var iframe = document.querySelector('iframe');
            var player = new Vimeo.Player(iframe);
            player.setCurrentTime({{ floor($lesson->watchedBy(auth()->user())) ?? 0}});
            player.play()

            $(document).ready(function () {
                player.on('pause', function(data) {
                    $.get('{{ url("/api/lesson/" . $lesson->id ."/store") }}/?watched='+data.seconds, function(resp){
                        console.log(resp);
                    });
                });

                player.on('play', function(data) {
                    $.get('{{ url("/api/lesson/" . $lesson->id ."/store") }}/?watched='+data.seconds, function(resp){
                        console.log(resp);
                    });
                });

                player.on('ended', function(data) {
                    console.log('Video has ended');
                    
                    $.get('{{ url("/api/lesson/" . $lesson->id ."/store") }}/?watched='+data.seconds, function(resp){
                        console.log(resp);
                    });

                    @if($lesson->next())
                        setTimeout(function() {
                            // redirect to next lesson
                            window.location.href = '{{ url("courses/lesson/". $lesson->next()->slug) }}';
                        }, 1000);
                    @endif
                });

                // browser exit
                /*window.onbeforeunload = function() {
                    let time = player.getCurrentTime();
                    let duration = player.getDuration();
                    console.log(time);
                    // let progress = time / duration * 100;
                    $.get('{{ url("/api/lesson/" . $lesson->id ."/store") }}/?watched='+time, function(resp){
                        console.log(resp);
                    });
                };*/
            });
        </script>
    @endif
@endpush