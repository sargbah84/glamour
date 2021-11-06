<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    //
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $lessons = Lesson::all();

        return response()->json($lessons);
    }

    public function details($id)
    {
        $lesson = Lesson::find($this->request->id);

        return response()->json($lesson);
    }

    public function create()
    {
        return view('backend.pages.lessons.create');
    }

    public function store()
    {
        $this->validate($this->request, [
            'name' => 'required',
            'module_id' => 'required',
            'description' => 'required',
            'video_url' => 'required',
        ]);

        $lesson = new Lesson();
        $lesson->name = $this->request->name;
        $lesson->slug = str_slug($this->request->name);
        $lesson->description = $this->request->description;
        $lesson->module_id = $this->request->module_id;
        $lesson->video_url = $this->request->video_url;
        $lesson->type = $this->request->type ?? 'vimeo';
        $lesson->duration = $this->request->duration ?? '10';
        $lesson->code = str_random(10);
        $lesson->save();

        return redirect()->route('admin.courses.details', $lesson->module->course->slug)->withFlashSuccess(__('Lesson created successfully'));
    }

    public function edit($id)
    {   
        $lesson = Lesson::find($id);

        return view('backend.pages.lessons.edit', compact('lesson'));
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'name' => 'required',
            'module_id' => 'required',
            'description' => 'required',
            'video_url' => 'required',
        ]);
        
        $lesson = Lesson::find($id);
        $lesson->name = $this->request->name;
        $lesson->slug = str_slug($this->request->name);
        $lesson->description = $this->request->description;
        $lesson->module_id = $this->request->module_id;
        $lesson->video_url = $this->request->video_url;
        $lesson->duration = $this->request->duration ?? '10';
        $lesson->save();

        return redirect()->route('admin.courses.details', $lesson->module->course->slug)->withFlashSuccess(__('Lesson updated successfully'));
    }

    public function delete($id)
    {
        $lesson = Lesson::find($id);
        $redirect_slug = $lesson->module->course->slug;
        $lesson->user_lessons()->delete();
        $lesson->delete();

        return response()->json([
                'status' => 'success', 
                'message' => __('Lesson deleted successfully'), 
                'redirect' => route('admin.courses.details', $redirect_slug)
            ]);
    }
}
