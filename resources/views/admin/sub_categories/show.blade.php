@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Sub Category Details</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.sub-categories.edit', $subCategory->id) }}" class="btn btn-gold rounded-pill px-4">Edit</a>
            <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Name</th>
                    <td>{{ $subCategory->name }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $subCategory->slug }}</td>
                </tr>
                 <tr>
                    <th>Parent Category</th>
                    <td>
                        <a href="{{ route('admin.categories.show', $subCategory->category_id) }}" class="text-decoration-none">
                            {{ $subCategory->category->name ?? 'N/A' }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $subCategory->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $subCategory->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $subCategory->created_at->format('M d, Y h:i A') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
