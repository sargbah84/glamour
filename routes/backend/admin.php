<?php

use App\Http\Controllers\Backend\LessonsController;
use App\Http\Controllers\Backend\ModulesController;
use App\Http\Controllers\Backend\CoursesController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PlansController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::group(['middleware' => 'role:'.config('global.access.role.admin')], function(){
    // Course routes
    Route::group(['prefix' => 'courses'], function(){
        Route::get('/', [CoursesController::class, 'index'])
            ->name('courses')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Courses'), route('admin.courses'));
            });

        Route::get('details/{slug}', [CoursesController::class, 'details'])
            ->name('courses.details')
            ->breadcrumbs(function (Trail $trail, $course) {
                $trail->parent('admin.courses')
                    ->push(__($course), route('admin.courses.details', $course));
            });

        Route::get('create', [CoursesController::class, 'create'])->name('courses.create');
        Route::get('edit/{id}', [CoursesController::class, 'edit'])->name('courses.edit');

        Route::post('store', [CoursesController::class, 'store'])->name('courses.store');
        Route::post('update/{id}', [CoursesController::class, 'update'])->name('courses.update');
        Route::post('delete/{id}', [CoursesController::class, 'delete'])->name('courses.delete');

        // Module routes
        Route::group(['prefix' => 'module'], function(){
            Route::get('/', [ModulesController::class, 'modules'])
                ->name('module')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.courses')
                        ->push(__('Modules'), route('admin.courses.module'));
                });
             
            Route::get('create', [ModulesController::class, 'create'])->name('courses.module.create');
            Route::get('edit/{id}', [ModulesController::class, 'edit'])->name('courses.module.edit');

            Route::post('store', [ModulesController::class, 'store'])->name('courses.module.store');
            Route::post('update/{id}', [ModulesController::class, 'update'])->name('courses.module.update');
            Route::post('delete/{id}', [ModulesController::class, 'delete'])->name('courses.module.delete');
        });

        // Lesson routes
        Route::group(['prefix' => 'lesson'], function(){
            Route::get('/', [LessonsController::class, 'lessons'])
                ->name('courses.lesson')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.courses')
                        ->push(__('Lessons'), route('admin.courses.lessons'));
                });

            Route::get('details/{slug}', [LessonsController::class, 'details'])
                ->name('courses.lesson')
                ->breadcrumbs(function (Trail $trail, $lesson) {
                    $trail->parent('admin.courses.lessons')
                        ->push(__($lesson), route('admin.courses.lesson', $lesson));
                });

            Route::get('create', [LessonsController::class, 'create'])->name('courses.lesson.create');
            Route::get('edit/{id}', [LessonsController::class, 'edit'])->name('courses.lesson.edit');

            Route::post('store', [LessonsController::class, 'store'])->name('courses.lesson.store');
            Route::post('update/{id}', [LessonsController::class, 'update'])->name('courses.lesson.update');
            Route::post('delete/{id}', [LessonsController::class, 'delete'])->name('courses.lesson.delete');

        });
    });

    // Plan routes
    Route::group(['prefix' => 'plans'], function(){
        Route::get('create', [PlansController::class, 'create'])->name('plans.create');
        Route::get('edit/{id}', [PlansController::class, 'edit'])->name('plans.edit');

        Route::post('store', [PlansController::class, 'store'])->name('plans.store');
        Route::post('update/{id}', [PlansController::class, 'update'])->name('plans.update');
        Route::post('delete/{id}', [PlansController::class, 'delete'])->name('plans.delete');
    });

});