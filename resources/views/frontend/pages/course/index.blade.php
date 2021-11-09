@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            @foreach($courses as $course)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <a href="{{ ($course->lessons->count()) ? url('/courses/' . $course->slug) : '#' }}"><img src="https://via.placeholder.com/640x450" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <a href="{{ ($course->lessons->count()) ? url('/courses/' . $course->slug) : '#' }}" class="card-title h5 text-dark">{{ $course->name }}</a>
                            <p class="card-text">{{ $course->description }}</p>
                            <a href="{{ url('/courses/' . $course->slug) }}" class="btn btn-primary{{ ($course->lessons->count()) ? '' : ' disabled' }}">View Course <i class="fas {{ ($course->lessons->count()) ? '' : ' fa-lock' }}"></i></a>
                        </div>
                    </div>
                </div><!--col-md-3-->
            @endforeach
        </div><!--row-->
    </div><!--container-->
@endsection
