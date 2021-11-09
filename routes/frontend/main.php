<?php

use App\Models\Course;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\CourseController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::group(['middleware' => ['auth', 'password.expires', config('global.access.middleware.verified')]], function () {

    Route::group(['prefix' => 'courses'], function(){

        Route::get('/', [CourseController::class, 'index'])
            ->name('pages.courses')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.index')
                    ->push(__('Courses'), route('frontend.pages.courses'));
            });

        Route::get('{slug}', [CourseController::class, 'details'])
            ->name('pages.courses.show')
            ->breadcrumbs(function (Trail $trail, $course) {
                $trail->parent('frontend.pages.courses')
                    ->push(__($course), route('frontend.pages.courses', $course));
            });

        Route::get('lesson/{slug}', [CourseController::class, 'player'])
            ->name('pages.courses.lesson.show')
            ->breadcrumbs(function (Trail $trail, $lesson) {
                $trail->parent('frontend.pages.courses')
                    ->push(__($lesson), route('frontend.pages.courses.lesson.show', $lesson));
            });
    
    });

    Route::group(['prefix' => 'api'], function(){

        Route::get('/lesson/{id}/store', [CourseController::class, 'time']);

    });

});        

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });

Route::get('plans', [HomeController::class, 'plans'])
    ->name('pages.plans')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Plans'), route('frontend.pages.plans'));
    });
