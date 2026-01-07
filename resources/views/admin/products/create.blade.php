@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Add New Product</h4>
        <a href="{{ route('admin.products.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        
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
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Brand</label>
                                    <select name="brand_id" class="form-select">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Category *</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Sub Category</label>
                                    <select name="sub_category_id" class="form-select">
                                        <option value="">Select Sub Category</option>
                                        @foreach($subCategories as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
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
                                <textarea name="description" class="form-control" rows="10" placeholder="Enter detailed product description..."></textarea>
                                <div class="form-text">Provide a detailed description of the product, its features, and benefits.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Optical Specs -->
                <div class="product-tab-pane" id="tab-optical">
                    <div class="card card-premium">
                        <div class="card-header-custom">
                            <h5 class="card-title"><i class="fa-solid fa-ruler-combined me-2"></i> Optical Measurements</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Lens Width (mm)</label>
                                    <input type="text" name="lens_width" class="form-control" placeholder="e.g., 52">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Bridge Width (mm)</label>
                                    <input type="text" name="bridge_width" class="form-control" placeholder="e.g., 18">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Temple Length (mm)</label>
                                    <input type="text" name="temple_length" class="form-control" placeholder="e.g., 140">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Frame Width (mm)</label>
                                    <input type="text" name="frame_width" class="form-control" placeholder="e.g., 135">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Frame Shape</label>
                                    <input type="text" name="frame_shape" class="form-control" placeholder="e.g., Oval, Rectangle">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Material</label>
                                    <input type="text" name="material" class="form-control" placeholder="e.g., Acetate, Metal">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Rec. Face Width</label>
                                    <input type="text" name="face_width_recommended" class="form-control" placeholder="e.g., Medium, Large">
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
                                        <option value="cm">Centimeters (cm)</option>
                                        <option value="inch">Inches (in)</option>
                                        <option value="mm">Millimeters (mm)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Length</label>
                                    <input type="number" step="0.01" name="length" class="form-control" placeholder="0.00">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Width</label>
                                    <input type="number" step="0.01" name="width" class="form-control" placeholder="0.00">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Height</label>
                                    <input type="number" step="0.01" name="height" class="form-control" placeholder="0.00">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Weight</label>
                                    <input type="number" step="0.01" name="weight" class="form-control" placeholder="0.00">
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
                                        <option value="{{ $attr->id }}" data-name="{{ $attr->name }}">{{ $attr->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Hold Ctrl/Cmd to select multiple attributes</div>
                            </div>

                            <div id="attributeValuesContainer"></div>

                            <div id="variantsContainer" style="display: none;">
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
                                    <input type="number" step="0.01" name="price" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Discount Price ($)</label>
                                    <input type="number" step="0.01" name="discount_price" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Stock Quantity</label>
                                    <input type="number" name="stock" class="form-control" value="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tax %</label>
                                    <input type="number" step="0.01" name="tax_percentage" class="form-control" value="8.25">
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
                            <div class="mb-4">
                                <label class="form-label fw-bold">Primary Image *</label>
                                <x-image-uploader 
                                    name="primary_image" 
                                    label="" 
                                    :multiple="false"
                                    :required="true"
                                />
                                <div class="form-text small text-muted">This will be the main product image displayed.</div>
                            </div>

                            <!-- Additional Images -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Additional Images</label>
                                <x-image-uploader 
                                    name="images[]" 
                                    label="" 
                                    :multiple="true"
                                    :required="false"
                                />
                                <div class="form-text small text-muted">Upload multiple images to show different angles or details.</div>
                            </div>
                        

                            <!-- Color Variants Images (Restored) -->
                            <hr class="my-4 border-secondary">
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label fw-bold mb-0">Color Variant Images</label>
                                <button type="button" class="btn btn-sm btn-gold rounded-pill" onclick="addColorVariant()">
                                    <i class="fa-solid fa-plus me-1"></i> Add Color Group
                                </button>
                            </div>
                            <div class="form-text small text-muted mb-3">
                                Upload images specific to a color variant. These will be shown when the user selects that color.
                            </div>

                            <div id="color-variants-container"></div>
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
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked>
                                <label class="form-check-label" for="statusSwitch">Active For Sale</label>
                            </div>
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="featuredSwitch">
                                <label class="form-check-label" for="featuredSwitch">Featured Product</label>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-gold w-100 rounded-pill fw-bold py-3">
                                <i class="fa-solid fa-check me-2"></i> Publish Product
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
    content: '\f00c'; /* Font Awesome check */
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #28a745; /* Green checkmark */
    font-size: 0.9em;
}

/* Ensure checkmark is visible against black background */
.product-tab-item.active.completed::after {
    color: #2ecc71; /* Brighter green for active state */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation
    document.querySelectorAll('.product-tab-item').forEach(tab => {
        tab.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            
            // Remove active class from all tabs and panes
            document.querySelectorAll('.product-tab-item').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.product-tab-pane').forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding pane
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

            // Find all required inputs/selects/textareas in this pane
            // Note: We check for 'required' attribute OR if it's the image tab which has custom validation
            const requiredInputs = pane.querySelectorAll('[required]');
            let isComplete = true;

            if (requiredInputs.length === 0) {
                // If no required fields, we might check if ANY field has value, or consider it optional (thus valid? or incomplete?)
                // Usually if a tab has no required fields, it's technically "complete" or "optional". 
                // Let's assume we only mark checkmark if explicitly filled or valid.
                // But user asked to mark "filled". Let's check if at least one input has value if no required fields, 
                // OR if all required fields are filled.
                
                // Let's stick to strict "all required fields filled" logic. 
                // If tab has NO required fields, maybe we don't show checkmark, or show it always?
                // Use case: Description tab has no required attribute on textarea? (It should probably be required)
                // Let's check if there are inputs.
                const allInputs = pane.querySelectorAll('input, select, textarea');
                if (allInputs.length > 0) {
                     // Check if any significant input has value
                     let hasValue = false;
                     allInputs.forEach(input => {
                         if (input.value.trim() !== '') hasValue = true;
                     });
                     // If no required inputs but has values filled, mark complete?
                     // Let's go with: if has required inputs -> all must be filled.
                     // If no required inputs -> if user entered data, mark complete.
                     if (!hasValue) isComplete = false; 
                }
            } else {
                 requiredInputs.forEach(input => {
                    if (input.type === 'file') {
                        // For file inputs, standard 'required' check might work if not empty
                        if (input.files.length === 0 && !input.dataset.hasExisting) { // custom data attr for edit mode
                             isComplete = false;
                        }
                    } else if (input.type === 'radio' || input.type === 'checkbox') {
                        // Check if at least one in group is checked? usually 'required' on one implies group requirement
                        if (!input.checked) {
                             // This is tricky for groups. But often 'required' is only on one.
                             // Simplified: if required and not checked -> false
                             // But wait, checkbox 'status' is required? usually pre-checked.
                             if (input.type === 'checkbox' && !input.checked) isComplete = false;
                        }
                    } else {
                        if (!input.value.trim()) {
                            isComplete = false;
                        }
                    }
                });
            }
            
            // Special handling for Images tab (Primary Image)
            if (tab.dataset.tab === 'images') {
                 // Check primary image input specifically (hidden input in x-image-uploader)
                 // The x-image-uploader puts the file input inside.
                 const primaryInput = pane.querySelector('input[name="primary_image"]');
                 if (primaryInput && primaryInput.files.length === 0) {
                     isComplete = false;
                 }
            }

            // Special handling for Attributes tab - check if variants generated? 
            // Or just if attributes selected.
            // Let's stick to simple input validation for now.

            if (isComplete) {
                tab.classList.add('completed');
            } else {
                tab.classList.remove('completed');
            }
        });
    }

    // specific validation for description tab
    // The description textarea might not have 'required' attribute but is usually important
    // Let's ensure description textarea has 'required' if strictly needed, or we check for value.
    
    // Listen for changes
    form.addEventListener('input', checkTabCompletion);
    form.addEventListener('change', checkTabCompletion);
    
    // Initial check
    checkTabCompletion();
});

// Dynamic Color Variant Image Sections
let colorVariantCount = 0;

function addColorVariant(colorName = null) {
    colorVariantCount++;
    const container = document.getElementById('color-variants-container');
    const id = colorVariantCount;
    
    // If auto-generated, mark it so we can find it layer
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
    
    // Create a temporary container to convert string to DOM nodes
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = html;
    const newGroup = tempDiv.firstElementChild;
    container.appendChild(newGroup);
    
    // Initialize the image uploader for this new group
    new ImageUploader(newGroup.querySelector('.image-uploader-wrapper'));
    
    // Re-run validation logic
    if (typeof checkTabCompletion === 'function') checkTabCompletion();
}

function removeColorGroup(id) {
    const group = document.getElementById(`color-group-${id}`);
    if (group) group.remove();
    // Re-run validation logic
    if (typeof checkTabCompletion === 'function') checkTabCompletion();
}

// Listen for Attribute Changes
document.addEventListener('attributeValueAdded', function(e) {
    const { attrName, value } = e.detail;
    // Check if attribute is related to Color (case insensitive)
    if (attrName && attrName.toLowerCase().includes('color')) {
        // Check if group already exists to prevent duplicates
        const existing = document.querySelector(`[data-generated-color="${value}"]`);
        if (!existing) {
            addColorVariant(value);
        }
    }
});

document.addEventListener('attributeValueRemoved', function(e) {
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
    $('#productForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        
        // Append selected attributes (if any) from the JS global variable
        if (typeof selectedAttributes !== 'undefined' && Object.keys(selectedAttributes).length > 0) {
            formData.append('selected_attributes', JSON.stringify(Object.keys(selectedAttributes)));
        }

        // Show Loading
        Swal.fire({
            title: 'Publishing Product...',
            html: 'Please wait while we process your request.<br><small class="text-muted">Uploading images may take a moment.</small>',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = response.redirect;
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Something went wrong.';
                
                if (xhr.status === 422) {
                    // Validation Errors
                    let errors = xhr.responseJSON.errors;
                    errorMessage = '<div class="text-start">';
                    $.each(errors, function(key, value) {
                        errorMessage += `<p class="text-danger mb-1"><i class="fa-solid fa-circle-exclamation me-2"></i> ${value[0]}</p>`;
                    });
                    errorMessage += '</div>';
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        html: errorMessage,
                        confirmButtonColor: '#d33'
                    });
                } else {
                    // Server Error
                    errorMessage = xhr.responseJSON?.message || xhr.statusText;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        confirmButtonColor: '#d33'
                    });
                }
            }
        });
    });
</script>
@endsection
