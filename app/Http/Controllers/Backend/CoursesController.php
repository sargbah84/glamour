<?php

namespace App\Http\Controllers\Backend;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    //
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $courses = Course::all();

        return view('backend.pages.courses.index', compact('courses'));
    }

    public function details($slug)
    {
        $course = Course::where('slug', $slug)->first();

        return view('backend.pages.courses.details', compact('course'));
    }

    public function create()
    {   
        return view('backend.pages.courses.create');
    }

    public function store()
    {
        $this->validate($this->request, [
            'name' => 'required',
        ]);

        $course = new Course();
        $course->name = $this->request->name;
        $course->slug = str_slug($this->request->name);
        $course->description = $this->request->description;
        $course->code = str_random(10);
        $course->save();

        // If tags input is not empty, store tags in database
        if($this->request->filled('tags')){
            $course->syncTagsNames($this->request->input('tags')); 
        }

        return redirect()->route('admin.courses')->withFlashSuccess(__('Course created successfully'));
    }

    public function edit($id)
    {
        $course = Course::find($id);

        return view('backend.pages.courses.edit', compact('course'));
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'name' => 'required',
        ]);

        $course = Course::find($id);
        $course->name = $this->request->name;
        $course->slug = str_slug($this->request->name);
        $course->description = $this->request->description;
        $course->code = $course->code ?? str_random(10);
        $course->save();

        // If tags input is not empty, store tags in database
        if($this->request->filled('tags')){
            $course->syncTagsNames($this->request->input('tags')); 
        }

        return redirect()->route('admin.courses')->withFlashSuccess(__('Course updated successfully'));
    }

    public function delete($id)
    {
        $course = Course::find($id);
        $course->modules()->delete();
        $course->lessons()->delete();
        $course->detachTags();
        $course->delete();

        return response()->json([
                'status' => 'success', 
                'message' => __('Course deleted successfully'), 
                'redirect' => route('admin.courses')
            ]);
    }
}
