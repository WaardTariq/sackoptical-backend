/**
 * Image Uploader JavaScript
 * Handles drag-drop, preview, and remove functionality
 */

class ImageUploader {
    constructor(container) {
        this.container = container;
        this.input = container.querySelector('.image-input');
        this.dropZone = container.querySelector('.drop-zone');
        this.previewContainer = container.querySelector('.image-preview-container');
        this.multiple = this.input?.hasAttribute('multiple');
        this.files = [];

        this.init();
    }

    init() {
        if (!this.input || !this.dropZone) return;

        // Drag and drop events
        this.dropZone.addEventListener('dragover', (e) => this.handleDragOver(e));
        this.dropZone.addEventListener('dragleave', (e) => this.handleDragLeave(e));
        this.dropZone.addEventListener('drop', (e) => this.handleDrop(e));

        // File input change
        this.input.addEventListener('change', (e) => this.handleFileSelect(e));

        // Click to upload
        this.dropZone.addEventListener('click', () => this.input.click());
    }

    handleDragOver(e) {
        e.preventDefault();
        e.stopPropagation();
        this.dropZone.classList.add('drag-over');
    }

    handleDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();
        this.dropZone.classList.remove('drag-over');
    }

    handleDrop(e) {
        e.preventDefault();
        e.stopPropagation();
        this.dropZone.classList.remove('drag-over');

        const files = Array.from(e.dataTransfer.files);
        this.processFiles(files);
    }

    handleFileSelect(e) {
        const files = Array.from(e.target.files);
        this.processFiles(files);
    }

    processFiles(files) {
        // Filter only images
        const imageFiles = files.filter(file => file.type.startsWith('image/'));

        if (!this.multiple) {
            this.files = imageFiles.slice(0, 1);
        } else {
            // Check for duplicates based on name and size
            const newFiles = imageFiles.filter(newFile =>
                !this.files.some(existing => existing.name === newFile.name && existing.size === newFile.size)
            );
            this.files = [...this.files, ...newFiles];
        }

        this.updateInputFiles();
        this.renderPreviews();
    }

    updateInputFiles() {
        const dt = new DataTransfer();
        this.files.forEach(file => dt.items.add(file));
        this.input.files = dt.files;
    }

    renderPreviews() {
        if (!this.previewContainer) return;

        this.previewContainer.innerHTML = '';

        this.files.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = (e) => {
                const preview = this.createPreviewElement(e.target.result, index);
                this.previewContainer.appendChild(preview);

                // Animate in
                setTimeout(() => {
                    preview.classList.add('show');
                }, 10);
            };

            reader.readAsDataURL(file);
        });

        // Hide drop zone if we have images
        if (this.files.length > 0) {
            this.dropZone.style.display = 'none';
        }
    }

    createPreviewElement(src, index) {
        const div = document.createElement('div');
        div.className = 'image-preview-item';
        div.innerHTML = `
            <img src="${src}" alt="Preview">
            <button type="button" class="remove-image" data-index="${index}">
                <i class="fa-solid fa-xmark"></i>
            </button>
        `;

        // Add remove handler
        div.querySelector('.remove-image').addEventListener('click', (e) => {
            e.stopPropagation();
            this.removeImage(index);
        });

        return div;
    }

    removeImage(index) {
        this.files.splice(index, 1);

        // Update file input
        const dt = new DataTransfer();
        this.files.forEach(file => dt.items.add(file));
        this.input.files = dt.files;

        this.renderPreviews();

        // Show drop zone if no images
        if (this.files.length === 0) {
            this.dropZone.style.display = 'flex';
        }
    }
}

// Initialize all image uploaders on page load
document.addEventListener('DOMContentLoaded', () => {
    const uploaders = document.querySelectorAll('.image-uploader-wrapper');
    uploaders.forEach(uploader => new ImageUploader(uploader));
});
