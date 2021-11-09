@extends('frontend.layouts.app')

@section('title', __($course->name))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ url('/courses/' . $course->slug) }}">
                            <img src="https://via.placeholder.com/640x460" class="img-fluid" alt="">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h3 class="my-2">{{ $course->name }}</h3>
                        <p>{{ $course->description ?? "Some quick example text to build on the card title and make up the bulk of the card's content." }}</p>
                        @if($course->lessons->first()->hasWatched(auth()->user()) > 0)
                            <a href="{{ url('/courses/lesson/'. $course->lessons->first()->slug) }}" class="btn btn-primary">
                                Continue Watching
                            </a>
                        @else
                            <a href="{{ url('/courses/lesson/'. $course->lessons->first()->slug) }}" class="btn btn-primary">
                                Start Learning
                            </a>
                        @endif
                    </div>
                </div>
                <div class="clearfix mt-4">
                    @foreach($course->modules as $module)
                        <ul class="list-group mb-3">
                            @if($module->lessons->count() > 0)
                                <li class="list-group-item active">
                                    {{ $module->name }}
                                </li>
                            
                                <div class="list-group">
                                    @foreach($module->lessons as $lesson)
                                        <a href="{{ url('/courses/lesson/' . $lesson->slug) }}" class="list-group-item list-group-item-action">
                                            {{ $lesson->name }}
                                            @if($lesson->isWatched(auth()->user()))    
                                                <i class="fas fa-check text-primary float-right" style="font-size: 16px;"></i>
                                            @else
                                                <span class="float-right" style="width: 80px; padding-top: 10px;">
                                                    <div class="progress" style="height: 4px;">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $lesson->progress(auth()->user()) }}%" aria-valuenow="{{ $lesson->progress(auth()->user()) }}" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <a href="{{ url('/courses') }}" class="btn btn-light btn-block">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('Back to Courses') }}
                        </a>
                    </div>
                </div>

            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
