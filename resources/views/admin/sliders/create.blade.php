@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Add New Banner</h4>
                <p class="text-muted small mb-0">Create a dynamic homepage slider banner.</p>
            </div>
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-premium shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Image Uploads -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Banner Background (Required)</label>
                                    <x-image-uploader name="image" label="" :multiple="false" :required="true" />
                                    <div class="form-text small text-muted">Dimensions: 1920x800px.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Secondary Image (Optional)</label>
                                    <x-image-uploader name="secondary_image" label="" :multiple="false" :required="false" />
                                    <div class="form-text small text-muted">Transparent PNG recommended.</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Title (Heading)</label>
                                    <input type="text" name="title" class="form-control form-control-lg"
                                        placeholder="e.g. Premium Eye Care">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Subtitle (Description)</label>
                                    <input type="text" name="subtitle" class="form-control"
                                        placeholder="e.g. Discover our exclusive collection">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Text Alignment</label>
                                    <select name="text_alignment" class="form-select">
                                        <option value="left">Left</option>
                                        <option value="center" selected>Center</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Button Text</label>
                                    <input type="text" name="button_text" class="form-control" placeholder="e.g. Shop Now">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Button Link (URL)</label>
                                    <input type="text" name="link" class="form-control" placeholder="e.g. /shop">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" value="0">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold mb-2">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="statusSwitch"
                                            checked>
                                        <label class="form-check-label" for="statusSwitch">Active</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button type="submit" class="btn btn-gold w-100 rounded-pill py-3 fw-bold">
                                <i class="fa-solid fa-check me-2"></i> Create Banner
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/image-uploader.js') }}"></script>
@endsection