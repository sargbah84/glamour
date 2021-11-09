@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <header class="clearfix animate__animated animate__fadeIn" style="height: 550px; background-color: rgba(0,0,0,0.1);">
        <div class="container">
            <div class="row justify-content-center text-center py-5" style="z-index: 10;">
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
    <section class="clearfix text-center bg-white" style="padding-top: 10%;">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-4 animate__animated animate__fadeInLeft">
                    <p class="text-muted"><i class="fas fa-image fa-5x"></i></p>
                    <h4>Test Section One</h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut, suscipit odit illo magnam quia aperiam iure assumenda quisquam harum, obcaecati? </p>
                </div>
                <div class="col-md-4 animate__animated animate__fadeIn">
                    <p class="text-muted"><i class="fas fa-image fa-5x"></i></p>
                    <h4>Test Section Two</h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut, suscipit odit illo magnam quia aperiam iure assumenda quisquam harum, obcaecati? </p>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInRight">
                    <p class="text-muted"><i class="fas fa-image fa-5x"></i></p>
                    <h4>Test Section Three</h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut, suscipit odit illo magnam quia aperiam iure assumenda quisquam harum, obcaecati? </p>
                </div>

            </div><!--row-->
        </div><!--container-->
    </section>
@endsection
