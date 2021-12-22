@extends('backend.layouts.app')

@section('title', _('Create Plan'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Create Plan')
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form action="{{ url('admin/plans/store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Plan Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Plan Details" rows="6" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" class="form-control" placeholder="Plan Price" value="{{ old('price') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="invoice_period" class="form-control" placeholder="Invoice Period" value="{{ old('invoice_period') }}" required>
                        </div>

                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-block">@lang('Create')</button>
                            <a href="{{ url()->previous() }}" class="btn btn-link btn-block">@lang('Cancel Edit')</a>
                        </div>

                    </form>

                </div><!--col-md-10-->
            </div><!--row-->
        </div>
    </div>
@endsection