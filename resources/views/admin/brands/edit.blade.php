@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Edit Brand</h4>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-light border rounded-pill px-4">
                <i class="fa-solid fa-arrow-left me-2"></i> Back
            </a>
        </div>

        <div class="card card-premium p-4">
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Brand Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
                </div>

                @php
                    $logoPath = $brand->logo;
                    if ($logoPath && !Str::startsWith($logoPath, 'storage/') && !Str::startsWith($logoPath, 'http')) {
                        $logoPath = 'storage/' . $logoPath;
                    }
                    $logoUrl = $brand->logo ? asset($logoPath) : null;
                @endphp
                <x-image-uploader name="logo" label="Brand Logo" :required="false" :existingImage="$logoUrl" />

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" {{ $brand->status ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusSwitch">Active Status</label>
                </div>

                <button type="submit" class="btn btn-gold rounded-pill px-5">Update Brand</button>
            </form>
        </div>
    </div>
@endsection