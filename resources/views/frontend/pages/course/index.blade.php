@extends('frontend.layouts.app')

@section('title', __('Courses'))

@section('content')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            @foreach($courses as $course)
                <div class="col-md-3 {{ ($course->lessons->count() > 0) ?: 'd-none' }}">
                    <div class="card mb-3">
                        <a href="{{ url('/courses/' . $course->slug) }}">
                            <img src="{{ $course->preview() }}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="{{ url('/courses/' . $course->slug) }}" class="card-title h5 text-dark">{{ $course->name }}</a>
                            <p class="card-text">{{ $course->description }}</p>
                            <a href="{{ url('/courses/' . $course->slug) }}" class="btn btn-primary">View Course <i class="fas {{ ($logged_in_user->hasActiveSubscription() && $course->lessons->count()) ? '' : ' fa-lock' }}"></i></a>
                        </div>
                    </div>
                </div><!--col-md-3-->
            @endforeach
        </div><!--row-->
    </div><!--container-->
@endsection
