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

        $plan = $this->plans->create([
            'name' => $this->request->name,
            'slug' => str_slug($this->request->name),
            'description' => $this->request->description,
            'is_active' => $this->request->input('is_active', 0),
            'price' => $this->request->price,
            'signup_fee' => '0.00',
            'invoice_period' => $this->request->invoice_period,
            'currency' => 'GEL',
        ]);

        return redirect()->route('admin.dashboard')->withFlashSuccess(__('Plan created successfully'));
    }

    public function edit($slug)
    {
        $plan = $this->plans->where('slug', $slug)->first();

        return view('backend.pages.plans.edit', compact('plan'));
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'name' => 'required|max:255',
        ]);

        $plan = $this->plans->where('id', $id)->first();
        
        $plan->name = $this->request->name;
        $plan->slug = str_slug($this->request->name);
        $plan->description = $this->request->description;
        $plan->is_active = $this->request->input('is_active', 0);
        $plan->price = $this->request->price;
        $plan->invoice_period = $this->request->invoice_period;
        $plan->currency = 'GEL';
        $plan->save();

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
