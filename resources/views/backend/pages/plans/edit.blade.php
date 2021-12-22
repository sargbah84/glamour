@extends('backend.layouts.app')

@section('title', _('Edit Plan'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Edit Plan')
            <a href="{{ url('admin/plans/delete/'. $plan->id) }}" class="btn btn-danger delete-item float-right">@lang('Delete Plan')</a>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/plans/update/' . $plan->id) }}" class="validate" method="POST">
                    
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Plan Name" value="{{ $plan->name }}" required>
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Plan Details" rows="5" required>{{ $plan->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" class="form-control" placeholder="Plan Price" value="{{ $plan->price }}" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="invoice_period" class="form-control" placeholder="Invoice Period" value="{{ $plan->invoice_period }}" required>
                        </div>

                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ $plan->is_active != 1 ?: 'checked' }}>
                            <label class="custom-control-label" for="is_active">Make Active</label>
                        </div>

                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-block">@lang('Update')</button>
                            <a href="{{ url('admin/dashboard') }}" class="btn btn-link btn-block">@lang('Cancel Update')</a>
                        </div>

                    </form>

                </div><!--col-md-10-->
            </div><!--row-->
        </div>
    </div>
@endsection