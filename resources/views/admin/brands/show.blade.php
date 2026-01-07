@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Brand Details</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-gold rounded-pill px-4">Edit</a>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                     <img src="{{ $brand->logo ? asset($brand->logo) : asset('assets/images/placeholder.png') }}" class="img-fluid rounded border mb-3" style="max-height: 200px;">
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Name</th>
                            <td>{{ $brand->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $brand->slug }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $brand->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $brand->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $brand->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
