@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Edit Product</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            id="productForm">
            @csrf @method('PUT')
            <input type="hidden" name="selected_attributes" id="hiddenSelectedAttributes">
            <input type="hidden" name="mixed_attribute_values" id="hiddenMixedAttributeValues">

            <div class="product-tabs-container">
                <!-- Vertical Tab Navigation -->
                <div class="product-tabs-nav">
                    <div class="product-tab-item active" data-tab="basic">
                        <div class="product-tab-icon"><i class="fa-solid fa-info-circle"></i></div>
                        <div class="product-tab-label">Basic Info</div>
                    </div>
                    <div class="product-tab-item" data-tab="description">
                        <div class="product-tab-icon"><i class="fa-solid fa-align-left"></i></div>
                        <div class="product-tab-label">Description</div>
                    </div>
                    <div class="product-tab-item" data-tab="optical">
                        <div class="product-tab-icon"><i class="fa-solid fa-glasses"></i></div>
                        <div class="product-tab-label">Optical Specs</div>
                    </div>
                    <div class="product-tab-item" data-tab="dimensions">
                        <div class="product-tab-icon"><i class="fa-solid fa-ruler-combined"></i></div>
                        <div class="product-tab-label">Dimensions & Weight</div>
                    </div>
                    <div class="product-tab-item" data-tab="attributes">
                        <div class="product-tab-icon"><i class="fa-solid fa-tags"></i></div>
                        <div class="product-tab-label">Attributes & Variants</div>
                    </div>
                    <div class="product-tab-item" data-tab="pricing">
                        <div class="product-tab-icon"><i class="fa-solid fa-dollar-sign"></i></div>
                        <div class="product-tab-label">Pricing & Stock</div>
                    </div>
                    <div class="product-tab-item" data-tab="images">
                        <div class="product-tab-icon"><i class="fa-solid fa-images"></i></div>
                        <div class="product-tab-label">Images</div>
                    </div>
                    <div class="product-tab-item" data-tab="settings">
                        <div class="product-tab-icon"><i class="fa-solid fa-cog"></i></div>
                        <div class="product-tab-label">Settings</div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="product-tabs-content">
                    <!-- Tab 1: Basic Info -->
                    <div class="product-tab-pane active" id="tab-basic">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title">General Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Product Name *</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $product->name) }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Brand</label>
                                        <select name="brand_id" class="form-select">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Category *</label>
                                        <select name="category_id" class="form-select">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Sub Category</label>
                                        <select name="sub_category_id" class="form-select">
                                            <option value="">Select Sub Category</option>
                                            @foreach($subCategories as $sub)
                                                <option value="{{ $sub->id }}" {{ $product->sub_category_id == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Description -->
                    <div class="product-tab-pane" id="tab-description">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title">Product Description</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" class="form-control" rows="10"
                                        placeholder="Enter detailed product description...">{{ old('description', $product->description) }}</textarea>
                                    <div class="form-text">Provide a detailed description of the product, its features, and
                                        benefits.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Optical Specs -->
                    <div class="product-tab-pane" id="tab-optical">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title"><i class="fa-solid fa-ruler-combined me-2"></i> Optical Measurements
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Lens Width (mm)</label>
                                        <input type="text" name="lens_width" class="form-control"
                                            value="{{ old('lens_width', $product->lens_width) }}" placeholder="e.g., 52">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Bridge Width (mm)</label>
                                        <input type="text" name="bridge_width" class="form-control"
                                            value="{{ old('bridge_width', $product->bridge_width) }}"
                                            placeholder="e.g., 18">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Temple Length (mm)</label>
                                        <input type="text" name="temple_length" class="form-control"
                                            value="{{ old('temple_length', $product->temple_length) }}"
                                            placeholder="e.g., 140">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Frame Width (mm)</label>
                                        <input type="text" name="frame_width" class="form-control"
                                            value="{{ old('frame_width', $product->frame_width) }}" placeholder="e.g., 135">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Frame Shape</label>
                                        <input type="text" name="frame_shape" class="form-control"
                                            value="{{ old('frame_shape', $product->frame_shape) }}"
                                            placeholder="e.g., Oval, Rectangle">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Material</label>
                                        <input type="text" name="material" class="form-control"
                                            value="{{ old('material', $product->material) }}"
                                            placeholder="e.g., Acetate, Metal">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Rec. Face Width</label>
                                        <input type="text" name="face_width_recommended" class="form-control"
                                            value="{{ old('face_width_recommended', $product->face_width_recommended) }}"
                                            placeholder="e.g., Medium, Large">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: Dimensions & Weight -->
                    <div class="product-tab-pane" id="tab-dimensions">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title">Product Dimensions & Weight</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Unit of Measurement</label>
                                        <select name="unit" class="form-select">
                                            <option value="">Select Unit</option>
                                            <option value="cm" {{ (old('unit', $product->unit) == 'cm') ? 'selected' : '' }}>
                                                Centimeters (cm)</option>
                                            <option value="inch" {{ (old('unit', $product->unit) == 'inch') ? 'selected' : '' }}>Inches (in)</option>
                                            <option value="mm" {{ (old('unit', $product->unit) == 'mm') ? 'selected' : '' }}>
                                                Millimeters (mm)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Length</label>
                                        <input type="number" step="0.01" name="length" class="form-control"
                                            value="{{ old('length', $product->length) }}" placeholder="0.00">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Width</label>
                                        <input type="number" step="0.01" name="width" class="form-control"
                                            value="{{ old('width', $product->width) }}" placeholder="0.00">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Height</label>
                                        <input type="number" step="0.01" name="height" class="form-control"
                                            value="{{ old('height', $product->height) }}" placeholder="0.00">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Weight</label>
                                        <input type="number" step="0.01" name="weight" class="form-control"
                                            value="{{ old('weight', $product->weight) }}" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 5: Attributes & Variants -->
                    <div class="product-tab-pane" id="tab-attributes">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title">Product Attributes & Variants</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Select Attributes</label>
                                    <select id="attributeSelect" class="form-select" multiple>
                                        @foreach($attributes as $attr)
                                            <option value="{{ $attr->id }}" data-name="{{ $attr->name }}">{{ $attr->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">Hold Ctrl/Cmd to select multiple attributes</div>
                                </div>

                                <div id="attributeValuesContainer"></div>

                                <div id="variantsContainer"
                                    style="{{ $product->variants->count() > 0 ? 'display: block;' : 'display: none;' }}">
                                    <hr class="my-4">
                                    <h6 class="fw-bold mb-3">Product Variants</h6>
                                    <div class="table-responsive">
                                        <table class="table variant-table">
                                            <thead>
                                                <tr>
                                                    <th>Variant</th>
                                                    <th>Price ($)</th>
                                                    <th>Stock</th>
                                                    <th>SKU</th>
                                                </tr>
                                            </thead>
                                            <tbody id="variantsTableBody">
                                                <!-- Pre-fill existing variants usually done via JS or server-side loop -->
                                                <!-- We will rely on JS hydration to re-generate these rows based on attributes, 
                                                                     OR simply list them here as input fields if we want simple editing.
                                                                     But the dynamic generator overwrites table. 
                                                                     So we must hydrate JS state. -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 6: Pricing & Stock -->
                    <div class="product-tab-pane" id="tab-pricing">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title">Pricing & Stock</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Base Price ($) *</label>
                                        <input type="number" step="0.01" name="price" class="form-control"
                                            value="{{ old('price', $product->price) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Discount Price ($)</label>
                                        <input type="number" step="0.01" name="discount_price" class="form-control"
                                            value="{{ old('discount_price', $product->discount_price) }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Stock Quantity</label>
                                        <input type="number" name="stock" class="form-control"
                                            value="{{ old('stock', $product->stock) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Tax %</label>
                                        <input type="number" step="0.01" name="tax_percentage" class="form-control"
                                            value="{{ old('tax_percentage', $product->tax_percentage) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 7: Images -->
                    <div class="product-tab-pane" id="tab-images">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title">Product Images</h5>
                            </div>
                            <div class="card-body">
                                <!-- Primary/Default Image -->
                                <!-- Primary/Default Image -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Primary Image *</label>
                                    @php
                                        $primImg = $product->primary_image;
                                        if ($primImg && !Str::startsWith($primImg, 'storage/') && !Str::startsWith($primImg, 'http')) {
                                            $primImg = 'storage/' . $primImg;
                                        }
                                        $primUrl = $primImg ? asset($primImg) : null;
                                    @endphp
                                    <x-image-uploader name="primary_image" label="" :multiple="false" :required="false"
                                        :existingImage="$primUrl" />
                                    <div class="form-text small text-muted">This will be the main product image displayed.
                                    </div>
                                </div>

                                <!-- Additional Images -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Additional Images</label>

                                    @if($product->productImages->whereNull('color')->count() > 0)
                                        <div class="d-flex gap-2 flex-wrap mb-3">
                                            @foreach($product->productImages->whereNull('color') as $img)
                                                @php
                                                    $addImg = $img->image_path;
                                                    if ($addImg && !Str::startsWith($addImg, 'storage/') && !Str::startsWith($addImg, 'http')) {
                                                        $addImg = 'storage/' . $addImg;
                                                    }
                                                @endphp
                                                <div class="position-relative border rounded p-1"
                                                    style="width: 100px; height: 100px;">
                                                    <img src="{{ asset($addImg) }}" class="w-100 h-100 object-fit-cover rounded"
                                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <x-image-uploader name="images[]" label="" :multiple="true" :required="false" />
                                    <div class="form-text small text-muted">Upload multiple images to show different angles
                                        or details.</div>
                                </div>

                                <!-- Color Variants Images (Restored) -->
                                <hr class="my-4 border-secondary">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <label class="form-label fw-bold mb-0">Color Variant Images</label>
                                    <button type="button" class="btn btn-sm btn-gold rounded-pill"
                                        onclick="addColorVariant()">
                                        <i class="fa-solid fa-plus me-1"></i> Add Color Group
                                    </button>
                                </div>
                                <div class="form-text small text-muted mb-3">
                                    Upload images specific to a color variant. These will be shown when the user selects
                                    that color.
                                </div>

                                <div id="color-variants-container">
                                    <!-- Re-hydrate Logic: To strictly re-edit existing color groups, 
                                                          we'd need to loop over existing images with color != null. 
                                                          I will add PHP loop here to render them. -->
                                    @php
                                        $colorImages = $product->productImages->whereNotNull('color')->groupBy('color');
                                        $colorIndex = 0;
                                     @endphp
                                    @foreach($colorImages as $color => $images)
                                        @php $colorIndex++; @endphp
                                        <div class="card bg-dark border-secondary mb-3" id="color-group-{{ $colorIndex }}"
                                            data-generated-color="{{ $color }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="fa-solid fa-palette text-gold"></i>
                                                        <span class="fw-bold">Color Variant Group #{{ $colorIndex }}</span>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        onclick="removeColorGroup({{ $colorIndex }})">
                                                        <i class="fa-solid fa-trash me-1"></i> Remove
                                                    </button>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Color Name</label>
                                                    <input type="text" class="form-control bg-black text-white border-secondary"
                                                        name="colors[{{ $colorIndex }}]" value="{{ $color }}" readonly>
                                                </div>

                                                <div class="d-flex gap-2 flex-wrap mb-3">
                                                    @foreach($images as $img)
                                                        @php
                                                            $colImg = $img->image_path;
                                                            if ($colImg && !Str::startsWith($colImg, 'storage/') && !Str::startsWith($colImg, 'http')) {
                                                                $colImg = 'storage/' . $colImg;
                                                            }
                                                        @endphp
                                                        <div class="position-relative border rounded p-1"
                                                            style="width: 80px; height: 80px;">
                                                            <img src="{{ asset($colImg) }}"
                                                                class="w-100 h-100 object-fit-cover rounded"
                                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="image-uploader-wrapper">
                                                    <input type="file" name="variant_images[{{ $colorIndex }}][]"
                                                        class="image-input d-none" accept="image/*" multiple>
                                                    <div class="drop-zone">
                                                        <div class="drop-zone-content">
                                                            <i class="fa-solid fa-images fa-2x text-muted mb-2"></i>
                                                            <p class="mb-1 fw-bold">Add Images for {{ $color }}</p>
                                                            <p class="text-muted small mb-0">Drag & drop or click
                                                                product-attributes.js</p>
                                                        </div>
                                                    </div>
                                                    <div class="image-preview-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 8: Settings -->
                    <div class="product-tab-pane" id="tab-settings">
                        <div class="card card-premium">
                            <div class="card-header-custom">
                                <h5 class="card-title">Product Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" {{ $product->status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusSwitch">Active For Sale</label>
                                </div>
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="featuredSwitch"
                                        {{ $product->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featuredSwitch">Featured Product</label>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-gold w-100 rounded-pill fw-bold py-3">
                                    <i class="fa-solid fa-check me-2"></i> Update Product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('assets/js/product-attributes.js') }}"></script>
    <script src="{{ asset('assets/js/image-uploader.js') }}"></script>

    <style>
        /* Tab Checkmark Styling */
        .product-tab-item {
            position: relative;
        }

        .product-tab-item.completed::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #28a745;
            font-size: 0.9em;
        }

        .product-tab-item.active.completed::after {
            color: #2ecc71;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tab Navigation
            document.querySelectorAll('.product-tab-item').forEach(tab => {
                tab.addEventListener('click', function () {
                    const tabName = this.dataset.tab;
                    document.querySelectorAll('.product-tab-item').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.product-tab-pane').forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('tab-' + tabName).classList.add('active');
                });
            });

            // Form Completion Validation
            const form = document.querySelector('form');
            const tabs = document.querySelectorAll('.product-tab-item');

            function checkTabCompletion() {
                tabs.forEach(tab => {
                    const tabId = 'tab-' + tab.dataset.tab;
                    const pane = document.getElementById(tabId);
                    if (!pane) return;
                    const requiredInputs = pane.querySelectorAll('[required]');
                    let isComplete = true;

                    if (requiredInputs.length === 0) {
                        const allInputs = pane.querySelectorAll('input, select, textarea');
                        if (allInputs.length > 0) {
                            let hasValue = false;
                            allInputs.forEach(input => {
                                if (input.value.trim() !== '') hasValue = true;
                            });
                            if (!hasValue) isComplete = false;
                        }
                    } else {
                        requiredInputs.forEach(input => {
                            if (input.type === 'file') {
                                if (input.files.length === 0 && !input.dataset.hasExisting && !document.querySelector('.existing-image-preview img')) {
                                    // Simplified check for edit mode
                                    // Check for existing image in DOM relative to input? 
                                    // x-image-uploader shows current image.
                                    const wrapper = input.closest('.image-uploader-wrapper');
                                    if (wrapper && wrapper.querySelector('.existing-image')) isComplete = true; // Assume existing means complete
                                    else isComplete = false;
                                } else if (input.files.length > 0) {
                                    isComplete = true;
                                }
                            } else if (input.type === 'radio' || input.type === 'checkbox') {
                                if (input.type === 'checkbox' && !input.checked) isComplete = false;
                            } else {
                                if (!input.value.trim()) {
                                    isComplete = false;
                                }
                            }
                        });
                    }
                    // Image logic refined
                    if (tab.dataset.tab === 'images') {
                        const primaryInput = pane.querySelector('input[name="primary_image"]');
                        const wrapper = primaryInput ? primaryInput.closest('.image-uploader-wrapper') : null;
                        const hasFile = primaryInput && primaryInput.files.length > 0;
                        const hasExisting = wrapper && wrapper.querySelector('.existing-image');

                        if (!hasFile && !hasExisting) {
                            isComplete = false;
                        }
                    }

                    // Attributes logic refined
                    if (tab.dataset.tab === 'attributes') {
                        if (typeof selectedAttributes !== 'undefined' && Object.keys(selectedAttributes).length > 0) {
                            isComplete = true;
                        } else {
                            isComplete = false;
                        }
                    }

                    if (isComplete) {
                        tab.classList.add('completed');
                    } else {
                        tab.classList.remove('completed');
                    }
                });
            }

            form.addEventListener('input', checkTabCompletion);
            form.addEventListener('change', checkTabCompletion);
            // checkTabCompletion(); // Don't call yet, wait for hydration


            // Hydrate Attributes and Variants Logic for Edit Mode
            // We need to populate selectedAttributes and attributeValues in product-attributes.js
            // This is a bit hacky but we inject the data directly.

            const existingAttributes = @json($product->attributes);
            const existingVariants = @json($product->variants);
            const allAttributes = @json($attributes);

            // Fallback: If attributes is empty but variants exist, reconstruct from variants
            if (existingAttributes.length === 0 && existingVariants.length > 0) {
                existingVariants.forEach(v => {
                    if (v.attribute_values) {
                        Object.keys(v.attribute_values).forEach(attrName => {
                            const value = v.attribute_values[attrName];
                            const attr = allAttributes.find(a => a.name === attrName);

                            if (attr) {
                                // Add to selectedAttributes
                                if (!selectedAttributes[attr.id]) {
                                    selectedAttributes[attr.id] = { id: attr.id, name: attr.name };

                                    // Also select in the dropdown
                                    const select = document.getElementById('attributeSelect');
                                    if (select) {
                                        Array.from(select.options).forEach(opt => {
                                            if (opt.value == attr.id) opt.selected = true;
                                        });
                                    }
                                }

                                // Add to attributeValues
                                if (!attributeValues[attr.id]) attributeValues[attr.id] = [];
                                if (!attributeValues[attr.id].includes(value)) attributeValues[attr.id].push(value);
                            }
                        });
                    }
                });

                renderAttributeValueInputs();
                Object.keys(attributeValues).forEach(attrId => renderAttributeValueTags(attrId));
                generateVariants();
                fillVariantData();
            } else if (existingAttributes.length > 0) {
                // Original logic for direct attributes
                const select = document.getElementById('attributeSelect');
                const options = Array.from(select.options);
                const attributesMap = {};

                existingAttributes.forEach(attr => {
                    const option = options.find(o => o.value == attr.id);
                    if (option) option.selected = true;

                    selectedAttributes[attr.id] = { id: attr.id, name: attr.name };

                    if (!attributesMap[attr.id]) attributesMap[attr.id] = [];
                    if (attr.pivot && attr.pivot.value) {
                        attributesMap[attr.id].push(attr.pivot.value);
                    }
                });

                renderAttributeValueInputs();

                Object.keys(attributesMap).forEach(attrId => {
                    const rawValues = attributesMap[attrId];
                    rawValues.forEach(rawVal => {
                        const values = rawVal.split(',').map(v => v.trim()).filter(v => v !== '');
                        values.forEach(val => {
                            if (!attributeValues[attrId]) attributeValues[attrId] = [];
                            if (!attributeValues[attrId].includes(val)) attributeValues[attrId].push(val);
                        });
                    });
                    renderAttributeValueTags(attrId);
                });

                generateVariants();
                fillVariantData();
            }

            function fillVariantData() {
                const existingVariants = @json($product->variants);
                const rows = document.querySelectorAll('#variantsTableBody tr');

                rows.forEach(row => {
                    const nameInput = row.querySelector('input[name$="[name]"]');
                    const variantName = nameInput.value;

                    // Find match
                    // Variant name format "Color: Red, Size: L"
                    // We hope the order matches. If not, we might need fuzzy match or match by attribute values.
                    // For now assume consistent ordering from generateCombinations.

                    const match = existingVariants.find(v => v.variant_name === variantName);
                    if (match) {
                        row.querySelector('input[name$="[price]"]').value = match.price;
                        row.querySelector('input[name$="[stock]"]').value = match.stock;
                        row.querySelector('input[name$="[sku]"]').value = match.sku || '';
                    }
                });
            }

            // Initial check after hydration
            checkTabCompletion();

        });

        // Dynamic Color Variant Image Sections (Edit Mode Logic)
        // We need to initialize count based on existing groups
        // Count how many .card[id^="color-group-"] exist
        let colorVariantCount = document.querySelectorAll('[id^="color-group-"]').length;

        function addColorVariant(colorName = null) {
            colorVariantCount++;
            const container = document.getElementById('color-variants-container');
            const id = colorVariantCount;

            const dataAttribute = colorName ? `data-generated-color="${colorName}"` : '';
            const nameValue = colorName ? `value="${colorName}" readonly` : 'placeholder="e.g. Matte Black, Rose Gold"';

            const html = `
                            <div class="card bg-dark border-secondary mb-3" id="color-group-${id}" ${dataAttribute}>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-palette text-gold"></i>
                                            <span class="fw-bold">Color Variant Group #${id}</span>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeColorGroup(${id})">
                                            <i class="fa-solid fa-trash me-1"></i> Remove
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Color Name</label>
                                        <input type="text" class="form-control bg-black text-white border-secondary"
                                               name="colors[${id}]" ${nameValue} required>
                                    </div>
                                    <div class="image-uploader-wrapper">
                                        <input type="file" name="variant_images[${id}][]" class="image-input d-none"
                                               accept="image/*" multiple required>
                                        <div class="drop-zone">
                                            <div class="drop-zone-content">
                                                <i class="fa-solid fa-images fa-2x text-muted mb-2"></i>
                                                <p class="mb-1 fw-bold">Upload Images for ${colorName || 'this Color'}</p>
                                                <p class="text-muted small mb-0">Drag & drop or click</p>
                                            </div>
                                        </div>
                                        <div class="image-preview-container"></div>
                                    </div>
                                </div>
                            </div>
                        `;
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            const newGroup = tempDiv.firstElementChild;
            container.appendChild(newGroup);
            new ImageUploader(newGroup.querySelector('.image-uploader-wrapper'));
            if (typeof checkTabCompletion === 'function') checkTabCompletion();
        }

        function removeColorGroup(id) {
            const group = document.getElementById(`color-group-${id}`);
            if (group) group.remove();
            if (typeof checkTabCompletion === 'function') checkTabCompletion();
        }

        document.addEventListener('attributeValueAdded', function (e) {
            const { attrName, value } = e.detail;
            if (attrName && attrName.toLowerCase().includes('color')) {
                const existing = document.querySelector(`[data-generated-color="${value}"]`);
                if (!existing) {
                    addColorVariant(value);
                }
            }
        });

        document.addEventListener('attributeValueRemoved', function (e) {
            const { attrName, value } = e.detail;
            if (attrName && attrName.toLowerCase().includes('color')) {
                const existing = document.querySelector(`[data-generated-color="${value}"]`);
                if (existing) {
                    existing.remove();
                    if (typeof checkTabCompletion === 'function') checkTabCompletion();
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log("Edit Page Loaded. Attaching submit handler.");

            $('#productForm').on('submit', function (e) {
                // Populate hidden inputs before submission
                if (typeof selectedAttributes !== 'undefined' && Object.keys(selectedAttributes).length > 0) {
                    $('#hiddenSelectedAttributes').val(JSON.stringify(Object.keys(selectedAttributes)));
                } else {
                    $('#hiddenSelectedAttributes').val('');
                }

                if (typeof attributeValues !== 'undefined' && Object.keys(attributeValues).length > 0) {
                    $('#hiddenMixedAttributeValues').val(JSON.stringify(attributeValues));
                } else {
                    $('#hiddenMixedAttributeValues').val('');
                }

                console.log("Form Submitting Standardly...");
                // Allow form to submit naturally
            });
        });
    </script>
@endsection