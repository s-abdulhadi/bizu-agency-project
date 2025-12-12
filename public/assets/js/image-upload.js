/**
 * Image Upload Handler with Preview and Validation
 * Provides client-side validation and preview functionality for image uploads
 */

class ImageUploadHandler {
    constructor(inputId, previewId, options = {}) {
        this.input = document.getElementById(inputId);
        this.preview = document.getElementById(previewId);
        
        // Default options
        this.options = {
            maxSize: options.maxSize || 5 * 1024 * 1024, // 5MB default
            allowedTypes: options.allowedTypes || ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'],
            maxWidth: options.maxWidth || 1920,
            maxHeight: options.maxHeight || 1920,
            showDimensions: options.showDimensions !== false,
            ...options
        };

        if (this.input) {
            this.init();
        }
    }

    init() {
        this.input.addEventListener('change', (e) => this.handleFileSelect(e));
    }

    handleFileSelect(event) {
        const file = event.target.files[0];
        
        if (!file) {
            this.clearPreview();
            return;
        }

        // Validate file
        const validation = this.validateFile(file);
        if (!validation.valid) {
            alert(validation.message);
            this.input.value = '';
            this.clearPreview();
            return;
        }

        // Show preview
        this.showPreview(file);
    }

    validateFile(file) {
        // Check file type
        if (!this.options.allowedTypes.includes(file.type)) {
            return {
                valid: false,
                message: `Invalid file type. Allowed types: ${this.options.allowedTypes.map(t => t.split('/')[1].toUpperCase()).join(', ')}`
            };
        }

        // Check file size
        if (file.size > this.options.maxSize) {
            const maxSizeMB = (this.options.maxSize / (1024 * 1024)).toFixed(1);
            return {
                valid: false,
                message: `File size must be less than ${maxSizeMB}MB. Your file is ${(file.size / (1024 * 1024)).toFixed(2)}MB`
            };
        }

        return { valid: true };
    }

    showPreview(file) {
        const reader = new FileReader();
        
        reader.onload = (e) => {
            if (!this.preview) return;

            // Create preview container
            this.preview.innerHTML = `
                <div style="position: relative; display: inline-block;">
                    <img src="${e.target.result}" 
                         style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); object-fit: cover;"
                         alt="Preview">
                    <button type="button" 
                            class="remove-preview-btn"
                            style="position: absolute; top: -8px; right: -8px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"
                            title="Remove image">×</button>
                </div>
                <div style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;">
                    <div><strong>File:</strong> ${file.name}</div>
                    <div><strong>Size:</strong> ${(file.size / 1024).toFixed(1)} KB</div>
                    <div id="image-dimensions-${this.input.id}"></div>
                </div>
            `;

            // Add remove button handler
            const removeBtn = this.preview.querySelector('.remove-preview-btn');
            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    this.input.value = '';
                    this.clearPreview();
                });
            }

            // Show image dimensions
            if (this.options.showDimensions) {
                const img = new Image();
                img.onload = () => {
                    const dimElement = document.getElementById(`image-dimensions-${this.input.id}`);
                    if (dimElement) {
                        dimElement.innerHTML = `<strong>Dimensions:</strong> ${img.width} × ${img.height}px`;
                        
                        // Warn if dimensions exceed max
                        if (img.width > this.options.maxWidth || img.height > this.options.maxHeight) {
                            dimElement.innerHTML += ` <span style="color: #f59e0b;">⚠️ Large image</span>`;
                        }
                    }
                };
                img.src = e.target.result;
            }
        };

        reader.readAsDataURL(file);
    }

    clearPreview() {
        if (this.preview) {
            this.preview.innerHTML = '';
        }
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Auto-initialize all image upload fields with data-preview attribute
    document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
        const previewId = input.getAttribute('data-preview');
        new ImageUploadHandler(input.id, previewId);
    });
});
