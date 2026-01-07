@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Attribute Details</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="btn btn-gold rounded-pill px-4">Edit</a>
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Name</th>
                    <td>{{ $attribute->name }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $attribute->slug }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $attribute->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $attribute->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
