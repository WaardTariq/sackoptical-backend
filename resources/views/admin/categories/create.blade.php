@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Add Category</h4>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>

    <div class="card card-premium p-4">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <x-image-uploader 
                name="image" 
                label="Category Image" 
                :required="false"
            />
            <div class="mb-3 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_featured" id="feat">
                <label class="form-check-label" for="feat">Featured Category?</label>
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status" id="status" checked>
                <label class="form-check-label" for="status">Active</label>
            </div>
            <button type="submit" class="btn btn-gold rounded-pill px-5">Save</button>
        </form>
    </div>
</div>
@endsection
