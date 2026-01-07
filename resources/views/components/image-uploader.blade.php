{{-- Image Uploader Component --}}
@props([
    'name' => 'image',
    'label' => 'Upload Image',
    'multiple' => false,
    'required' => false,
    'existingImage' => null,
    'accept' => 'image/*'
])

<div class="mb-3">
    @if($label)
        <label class="form-label fw-bold">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    @endif
    
    <div class="image-uploader-wrapper">
        <!-- Hidden File Input -->
        <input 
            type="file" 
            name="{{ $name }}" 
            class="image-input d-none" 
            accept="{{ $accept }}"
            {{ $multiple ? 'multiple' : '' }}
            {{ $required ? 'required' : '' }}
        >
        
        <!-- Drop Zone -->
        <div class="drop-zone">
            <div class="drop-zone-content">
                <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                <p class="mb-1 fw-bold">Drag & Drop your image here</p>
                <p class="text-muted small mb-0">or click to browse</p>
            </div>
        </div>
        
        <!-- Preview Container -->
        <div class="image-preview-container"></div>
        
        <!-- Existing Image (for edit forms) -->
        @if($existingImage)
            <div class="existing-image mt-3">
                <label class="form-label small text-muted">Current Image:</label>
                <div class="existing-image-preview">
                    <img src="{{ asset($existingImage) }}" alt="Current">
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.image-uploader-wrapper {
    position: relative;
}

.drop-zone {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 160px;
    border: 2px dashed #d4af37;
    border-radius: 10px;
    background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.drop-zone::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
    transition: left 0.5s ease;
}

.drop-zone:hover::before {
    left: 100%;
}

.drop-zone:hover {
    border-color: #b8941f;
    background: linear-gradient(135deg, #fff9e6 0%, #fff5d6 100%);
    transform: scale(1.01);
}

.drop-zone.drag-over {
    border-color: #d4af37;
    background: linear-gradient(135deg, #fff9e6 0%, #ffe6b3 100%);
    border-width: 3px;
    transform: scale(1.02);
}

.drop-zone-content {
    text-align: center;
    pointer-events: none;
    z-index: 1;
}

.drop-zone-content i {
    font-size: 2rem;
    animation: bounce 2s ease-in-out infinite;
}

.drop-zone-content p {
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.drop-zone-content p.fw-bold {
    font-size: 0.95rem;
}

.image-preview-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
    margin-top: 12px;
}

.image-preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s ease;
    aspect-ratio: 1;
}

.image-preview-item.show {
    opacity: 1;
    transform: scale(1);
}

.image-preview-item:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.image-preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: rgba(220, 53, 69, 0.9);
    border: 2px solid white;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0;
    transform: scale(0.8);
    font-size: 12px;
}

.image-preview-item:hover .remove-image {
    opacity: 1;
    transform: scale(1);
}

.remove-image:hover {
    background: #dc3545;
    transform: scale(1.1) rotate(90deg);
}

.existing-image-preview {
    width: 100px;
    height: 100px;
    border-radius: 6px;
    overflow: hidden;
    border: 2px solid #dee2e6;
}

.existing-image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-8px); }
    60% { transform: translateY(-4px); }
}
</style>
