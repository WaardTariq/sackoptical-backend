@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Edit Lens Coating</h4>
        <a href="{{ route('admin.lens-coatings.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>
    <div class="card card-premium p-4">
        <form action="{{ route('admin.lens-coatings.update', $lensCoating->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $lensCoating->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $lensCoating->price }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Tax Percentage</label>
                <input type="number" step="0.01" name="tax_percentage" class="form-control" value="{{ $lensCoating->tax_percentage }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ $lensCoating->description }}</textarea>
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status" {{ $lensCoating->status ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>
            <button type="submit" class="btn btn-gold rounded-pill px-5">Update</button>
        </form>
    </div>
</div>
@endsection
