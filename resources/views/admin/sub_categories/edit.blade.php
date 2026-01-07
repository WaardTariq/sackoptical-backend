@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Edit Sub Category</h4>
        <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>

    <div class="card card-premium p-4">
        <form action="{{ route('admin.sub-categories.update', $subCategory->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Parent Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $subCategory->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $subCategory->name }}" required>
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status" id="status" {{ $subCategory->status ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
            </div>
            <button type="submit" class="btn btn-gold rounded-pill px-5">Update</button>
        </form>
    </div>
</div>
@endsection
