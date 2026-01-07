@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Edit Category</h4>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>

        <div class="card card-premium p-4">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                @php
                    $imagePath = $category->image;
                    if ($imagePath && !Str::startsWith($imagePath, 'storage/') && !Str::startsWith($imagePath, 'http')) {
                        $imagePath = 'storage/' . $imagePath;
                    }
                    $imageUrl = $category->image ? asset($imagePath) : null;
                @endphp
                <x-image-uploader name="image" label="Image" :multiple="false" :required="false" :existingImage="$imageUrl" />
                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="feat" {{ $category->is_featured ? 'checked' : '' }}>
                    <label class="form-check-label" for="feat">Featured Category?</label>
                </div>
                <div class="mb-4 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="status" {{ $category->status ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
                <button type="submit" class="btn btn-gold rounded-pill px-5">Update</button>
            </form>
        </div>
    </div>
@endsection