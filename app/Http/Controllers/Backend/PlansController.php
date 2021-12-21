<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    //
    public $request, $plans;

    public function __construct(Request $request)
    {

        $this->request = $request;
        $this->plans = app('rinvex.subscriptions.plan');

    }

    public function create()
    {
        return view('backend.pages.plans.create');
    }

    public function details($id)
    {
        $plan = $this->plans->where('id', $id)->first();

        return response()->json($plan);
    }

    public function store()
    {
        
        $this->validate($this->request, [
            'name' => 'required|max:255',
        ]);

        return redirect()->route('admin.dashboard', $module->course->slug)->withFlashSuccess(__('Module created successfully'));
    }

    public function edit($id)
    {
        $module = Module::find($id);

        return view('backend.pages.plans.edit', compact('module'));
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'name' => 'required|max:255',
        ]);

        return redirect()->route('admin.dashboard')->withFlashSuccess(__('Plans updated successfully'));
    }

    public function delete($id)
    {
        $plan = $this->plans->where('id', $id)->first();
        $plan->delete();

        return response()->json([
                'status' => 'success', 
                'message' => __('Plan deleted successfully'), 
                'redirect' => route('admin.dashboard')
            ]);
    }

}
