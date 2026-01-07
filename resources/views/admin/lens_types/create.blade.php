@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Add Lens Type</h4>
            <a href="{{ route('admin.lens-types.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
        <div class="card card-premium p-4">
            <form action="{{ route('admin.lens-types.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. Single Vision">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Price Modifier ($)</label>
                            <input type="number" step="0.01" name="price_modifier" class="form-control" required
                                value="0.00">
                            <div class="form-text">Amount to add to base frame price</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <x-image-uploader name="image" label="Image (Optional)" :multiple="false" :required="false" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-4 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" checked>
                    <label class="form-check-label">Active</label>
                </div>
                <button type="submit" class="btn btn-gold rounded-pill px-5">Save</button>
            </form>
        </div>
    </div>
@endsection