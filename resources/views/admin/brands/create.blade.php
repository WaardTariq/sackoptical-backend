@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Add New Brand</h4>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-light border rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="card card-premium p-4">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Brand Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g RayBan" required>
            </div>

            <x-image-uploader 
                name="logo" 
                label="Brand Logo" 
                :required="false"
            />

            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" checked>
                <label class="form-check-label" for="statusSwitch">Active Status</label>
            </div>

            <button type="submit" class="btn btn-gold rounded-pill px-5">Save Brand</button>
        </form>
    </div>
</div>
@endsection
