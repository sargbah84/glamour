@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <header class="clearfix bg-dark" style="height: 550px;">
        <div class="container">
            <div class="row justify-content-center text-center text-white py-5" style="z-index: 10;">
                <div class="col-sm-8">
                    <div class="clearfix">
                        <h1 class="">Big Header Goes Here</h1>
                        <p class="px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. In minus repellendus fugiat quis aspernatur sunt dicta, tenetur voluptas recusandae quisquam harum iure molestiae voluptatum.</p>
                        <div class="clearfix mt-5">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/256470214?h=0a6898a592" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container py-4">
        <div class="row justify-content-center">

        </div><!--row-->
    </div><!--container-->
@endsection
