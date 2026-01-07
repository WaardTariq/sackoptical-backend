@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Edit Attribute</h4>
        <a href="{{ route('admin.attributes.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>
    <div class="card card-premium p-4">
        <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Attribute Name</label>
                <input type="text" name="name" class="form-control" value="{{ $attribute->name }}" required>
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status" id="status" {{ $attribute->status ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
            </div>
            <button type="submit" class="btn btn-gold rounded-pill px-5">Update</button>
        </form>
    </div>
</div>
@endsection
