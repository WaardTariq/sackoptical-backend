@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Product Details</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="text-muted">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-gold rounded-pill px-4"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Details -->
        <div class="col-lg-8">
            <div class="card card-premium mb-4">
                <div class="card-header-custom d-flex justify-content-between">
                    <h5 class="card-title mb-0">Product Information</h5>
                    <span class="badge {{ $product->status ? 'bg-success' : 'bg-secondary' }} rounded-pill">{{ $product->status ? 'Active' : 'Inactive' }}</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small text-muted text-uppercase fw-bold">Name</label>
                            <p class="fw-bold mb-0">{{ $product->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted text-uppercase fw-bold">Slug</label>
                            <p class="mb-0 text-muted">{{ $product->slug }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small text-muted text-uppercase fw-bold">Brand</label>
                            <p class="mb-0">{{ $product->brand->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small text-muted text-uppercase fw-bold">Category</label>
                            <p class="mb-0">{{ $product->category->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small text-muted text-uppercase fw-bold">Sub Category</label>
                            <p class="mb-0">{{ $product->subCategory->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <label class="small text-muted text-uppercase fw-bold mb-2">Description</label>
                        <div class="text-muted">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optical Specs -->
            <div class="card card-premium mb-4">
                <div class="card-header-custom">
                    <h5 class="card-title mb-0"><i class="fa-solid fa-glasses me-2 text-gold"></i> Optical Measurements</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-3">
                        <div class="col">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted d-block text-uppercase">Lens Width</small>
                                <span class="fw-bold h5">{{ $product->lens_width ? $product->lens_width . ' mm' : '-' }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted d-block text-uppercase">Bridge</small>
                                <span class="fw-bold h5">{{ $product->bridge_width ? $product->bridge_width . ' mm' : '-' }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted d-block text-uppercase">Temple</small>
                                <span class="fw-bold h5">{{ $product->temple_length ? $product->temple_length . ' mm' : '-' }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted d-block text-uppercase">Frame Width</small>
                                <span class="fw-bold h5">{{ $product->frame_width ? $product->frame_width . ' mm' : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-md-4">
                            <label class="small text-muted text-uppercase fw-bold">Frame Shape</label>
                            <p class="mb-0">{{ $product->frame_shape ?? '-' }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small text-muted text-uppercase fw-bold">Material</label>
                            <p class="mb-0">{{ $product->material ?? '-' }}</p>
                        </div>
                         <div class="col-md-4">
                            <label class="small text-muted text-uppercase fw-bold">Rec. Face Width</label>
                            <p class="mb-0">{{ $product->face_width_recommended ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dimensions & Weight -->
            <div class="card card-premium mb-4">
                <div class="card-header-custom">
                    <h5 class="card-title mb-0"><i class="fa-solid fa-ruler-combined me-2 text-info"></i> Dimensions & Weight</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="small text-muted text-uppercase fw-bold">Length</label>
                            <p class="fw-bold h6">{{ $product->length ? $product->length . ' ' . $product->unit : '-' }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small text-muted text-uppercase fw-bold">Width</label>
                            <p class="fw-bold h6">{{ $product->width ? $product->width . ' ' . $product->unit : '-' }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small text-muted text-uppercase fw-bold">Height</label>
                            <p class="fw-bold h6">{{ $product->height ? $product->height . ' ' . $product->unit : '-' }}</p>
                        </div>
                         <div class="col-md-3 mb-3">
                            <label class="small text-muted text-uppercase fw-bold">Weight</label>
                            <p class="fw-bold h6">{{ $product->weight ? $product->weight . ' ' . $product->unit : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Variants Table -->
            @if($product->variants->count() > 0)
            <div class="card card-premium mb-4">
                <div class="card-header-custom">
                    <h5 class="card-title mb-0">Product Variants</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Variant Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->variants as $variant)
                            <tr>
                                <td class="fw-bold">{{ $variant->variant_name }}</td>
                                <td>{{ $variant->sku ?? '-' }}</td>
                                <td>${{ number_format($variant->price, 2) }}</td>
                                <td>
                                    @if($variant->stock > 0)
                                        <span class="badge bg-success">{{ $variant->stock }}</span>
                                    @else
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Images & Colors -->
            <div class="card card-premium">
                <div class="card-header-custom">
                    <h5 class="card-title mb-0">Images & Variants</h5>
                </div>
                <div class="card-body">
                    <!-- Primary Image -->
                    <div class="mb-4">
                        <h6 class="fw-bold border-bottom pb-2">Primary Image</h6>
                        <div class="p-2 border rounded d-inline-block">
                             @if($product->primary_image)
                                <img src="{{ asset($product->primary_image) }}" class="rounded" style="max-height: 200px; max-width: 100%;background-color: #ffffff42;">
                             @else
                                <span class="text-muted">No primary image set.</span>
                             @endif
                        </div>
                    </div>

                    <!-- Additional Images -->
                    @php
                        $generalImages = $product->productImages->whereNull('color');
                        $groupedImages = $product->productImages->whereNotNull('color')->groupBy('color');
                    @endphp

                    @if($generalImages->count() > 0)
                    <div class="mb-4">
                        <h6 class="fw-bold border-bottom pb-2">Additional Images</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($generalImages as $img)
                                <div class="position-relative border rounded p-1" style="width: 100px; height: 100px;">
                                    <img src="{{ asset($img->image_path) }}" class="w-100 h-100 object-fit-cover rounded" style="background-color: #ffffff42;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @foreach($groupedImages as $color => $images)
                        <div class="mb-4">
                            <h6 class="fw-bold border-bottom pb-2">Color: {{ $color }}</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($images as $img)
                                    <div class="position-relative border rounded p-1" style="width: 100px; height: 100px;">
                                        <img src="{{ asset($img->image_path) }}" class="w-100 h-100 object-fit-cover rounded" style="background-color: #ffffff42;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Pricing & Stats -->
        <div class="col-lg-4">
            <div class="card card-premium mb-4">
                <div class="card-header-custom">
                     <h5 class="card-title mb-0">Pricing</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Base Price</span>
                        <span class="h5 fw-bold mb-0">${{ number_format($product->price, 2) }}</span>
                    </div>
                    @if($product->discount_price)
                     <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Discount Price</span>
                        <span class="h5 fw-bold mb-0 text-danger">${{ number_format($product->discount_price, 2) }}</span>
                     </div>
                    @endif
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Tax Rate</span>
                        <span class="fw-bold">{{ $product->tax_percentage }}%</span>
                    </div>
                </div>
            </div>

            <div class="card card-premium mb-4">
                <div class="card-header-custom">
                     <h5 class="card-title mb-0">Inventory & Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Total Stock</span>
                        @if($product->stock > 10)
                            <span class="badge bg-success">In Stock ({{ $product->stock }})</span>
                        @elseif($product->stock > 0)
                             <span class="badge bg-warning">Low Stock ({{ $product->stock }})</span>
                        @else
                             <span class="badge bg-danger">Out of Stock</span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                         <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" {{ $product->status ? 'checked' : '' }} disabled>
                            <label class="form-check-label">{{ $product->status ? 'Active For Sale' : 'Not Active' }}</label>
                        </div>
                    </div>
                     <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" {{ $product->is_featured ? 'checked' : '' }} disabled>
                        <label class="form-check-label">{{ $product->is_featured ? 'Featured Product' : 'Not Featured' }}</label>
                    </div>
                </div>
            </div>
            
            <div class="card card-premium">
                 <div class="card-header-custom">
                     <h5 class="card-title mb-0">Attributes</h5>
                </div>
                <div class="card-body">
                     @if($product->attributes->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($product->attributes->unique('id') as $attr)
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-muted">{{ $attr->name }}</span>
                                    <span class="fw-bold">
                                        {{ $product->attributes->where('id', $attr->id)->pluck('pivot.value')->join(', ') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                     @else
                        <p class="text-muted small mb-0">No attributes assigned.</p>
                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
