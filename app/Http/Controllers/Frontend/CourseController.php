<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Module;
use App\Models\Course;
use App\Models\UserLesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;

class CourseController extends Controller
{

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    //
    public function index()
    {
        $courses = Course::all();

        return view('frontend.pages.course.index', compact('courses'));
    }

    public function details($slug)
    {
        $course = Course::where('slug', $slug)->first();
        return view('frontend.pages.course.details', compact('course'));
    }

    public function player($code)
    {
        $lesson = Lesson::where('code', $code)->first();
        $modules = Module::where('course_id', $lesson->module->course_id)->get();

        return view('frontend.pages.course.player', compact('lesson', 'modules'));
    }

    public function time($id)
    {
        UserLesson::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $id,
            ],
            [
                'watched' => $this->request->input('watched'),
            ]);
            
        return response()->json(['time' => time()]);
    }

}
