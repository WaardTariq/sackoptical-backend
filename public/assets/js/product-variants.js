/**
 * Enhanced Product Color Variant Manager
 * Handles dynamic color variants with multi-image uploader
 */

let variantIndex = 0;
const variantUploaders = new Map();

function addColorVariant() {
    const container = document.getElementById('color-variants-container');
    const variantId = `variant-${variantIndex}`;

    const variantCard = document.createElement('div');
    variantCard.className = 'card border-0 shadow-sm mb-3 bg-light variant-row animate-fade-in-up';
    variantCard.id = `variant-row-${variantIndex}`;
    variantCard.innerHTML = `
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-palette me-2 text-gold"></i>
                    Color Variant #${variantIndex + 1}
                </h6>
                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill hover-scale" onclick="removeVariant(${variantIndex})">
                    <i class="fa-solid fa-trash me-1"></i> Remove
                </button>
            </div>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold small">Color Name</label>
                    <input type="text" 
                           name="colors[${variantIndex}]" 
                           class="form-control input-glow" 
                           placeholder="e.g. Matte Black, Rose Gold" 
                           required>
                </div>
                <div class="col-md-8">
                    <div class="image-uploader-wrapper" id="${variantId}">
                        <input type="file" 
                               name="variant_images.${variantIndex}[]" 
                               class="image-input d-none" 
                               accept="image/*"
                               multiple
                               required>
                        
                        <div class="drop-zone drop-zone-compact">
                            <div class="drop-zone-content">
                                <i class="fa-solid fa-images fa-2x text-muted mb-2"></i>
                                <p class="mb-1 fw-bold small">Upload Images for this Color</p>
                                <p class="text-muted small mb-0">Drag & drop or click</p>
                            </div>
                        </div>
                        
                        <div class="image-preview-container"></div>
                    </div>
                </div>
            </div>
        </div>
    `;

    container.appendChild(variantCard);

    // Initialize image uploader for this variant
    const uploaderWrapper = document.getElementById(variantId);
    if (uploaderWrapper) {
        new ImageUploader(uploaderWrapper);
    }

    variantIndex++;
}

function removeVariant(index) {
    const row = document.getElementById(`variant-row-${index}`);
    if (row) {
        row.classList.add('animate-fade-out');
        setTimeout(() => row.remove(), 300);
    }
}

// Add CSS for compact drop zone
const style = document.createElement('style');
style.textContent = `
    .drop-zone-compact {
        min-height: 150px !important;
        border-width: 2px;
    }
    
    .drop-zone-compact .drop-zone-content i {
        animation: none;
    }
    
    .variant-row {
        transition: all 0.3s ease;
    }
    
    .animate-fade-out {
        opacity: 0;
        transform: translateX(-20px);
    }
`;
document.head.appendChild(style);
