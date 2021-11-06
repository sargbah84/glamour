<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    //
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $modules = Module::all();

        return response()->json($modules);
    }

    public function create()
    {
        return view('backend.pages.modules.create');
    }

    public function details($id)
    {
        $module = Module::find($id);

        return response()->json($module);
    }

    public function store()
    {
        
        $this->validate($this->request, [
            'name' => 'required|max:255',
            'course_id' => 'required|numeric'
        ]);

        $module = new Module;
        $module->name = $this->request->name;
        $module->slug = str_slug($this->request->name);
        $module->course_id = $this->request->course_id;
        $module->description = $this->request->description;
        $module->code = str_random(10);
        $module->save();

        return redirect()->route('admin.courses.details', $module->course->slug)->withFlashSuccess(__('Module created successfully'));
    }

    public function edit($id)
    {
        $module = Module::find($id);

        return view('backend.pages.modules.edit', compact('module'));
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'name' => 'required|max:255',
            'course_id' => 'required|numeric'
        ]);

        $module = Module::find($id);
        $module->name = $this->request->name;
        $module->slug = str_slug($this->request->name);
        $module->course_id = $this->request->course_id;
        $module->description = $this->request->description;
        $module->save();

        return redirect()->route('admin.courses.details', $module->course)->withFlashSuccess(__('Module updated successfully'));
    }

    public function delete($id)
    {
        $module = Module::find($id);
        $redirect_slug = $module->course->slug;
        $module->lessons()->delete();
        $module->delete();

        return response()->json([
                'status' => 'success', 
                'message' => __('Lesson deleted successfully'), 
                'redirect' => route('admin.courses.details', $redirect_slug)
            ]);
    }
}
