/**
 * Bizu Agency - Main JS
 * Functionality: Mobile menu, search, cart simulation, form validation.
 */

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initSearch();
    initFormValidation();
    initImagePreviews();
});

/* --- Mobile Menu --- */
function initMobileMenu() {
    const menuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (menuBtn && navLinks) {
        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active'); // CSS needs to handle .active state for mobile
            const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', !isExpanded);
        });
    }
}

/* --- Search Dropdown (Mock) --- */
/* --- Search Dropdown (AJAX) --- */
function initSearch() {
    const searchInput = document.querySelector('.search-input');
    const searchResults = document.querySelector('.search-results');
    const categoryFilter = document.querySelector('.search-category');
    let searchTimeout;

    if (!searchInput || !searchResults) return;

    // Function to perform search
    function performSearch() {
        clearTimeout(searchTimeout);
        const query = searchInput.value;
        const category = categoryFilter ? categoryFilter.value : 'all';

        if (query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        // Show loading
        searchResults.innerHTML = '<div style="padding: 1rem; text-align: center; color: #6b7280;">🔍 Searching...</div>';
        searchResults.style.display = 'block';

        searchTimeout = setTimeout(() => {
            fetch(`/ajax/search?query=${encodeURIComponent(query)}&category=${category}`)
                .then(response => response.json())
                .then(data => {
                    renderSearchResults(data, searchResults);
                    searchResults.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    searchResults.innerHTML = '<div style="padding: 1rem; text-align: center; color: #ef4444;">Error loading results</div>';
                });
        }, 250);
    }

    // Search on input
    searchInput.addEventListener('input', performSearch);

    // Search on category change
    if (categoryFilter) {
        categoryFilter.addEventListener('change', () => {
            if (searchInput.value.length >= 2) {
                performSearch();
            }
        });
    }

    // Hide on click outside
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target) && (!categoryFilter || !categoryFilter.contains(e.target))) {
            searchResults.style.display = 'none';
        }
    });
}

function renderSearchResults(data, container) {
    // Handle new API response format
    const items = data.results || data || [];

    if (items.length === 0) {
        container.innerHTML = `
            <div style="padding: 2rem; text-align: center;">
                <div style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem;">🔍</div>
                <div style="color: #6b7280;">No results found</div>
            </div>
        `;
        return;
    }

    // Group by category
    const grouped = {};
    items.forEach(item => {
        const cat = item.category || item.type || 'Other';
        if (!grouped[cat]) grouped[cat] = [];
        grouped[cat].push(item);
    });

    let html = `<div style="padding: 0.5rem 1rem; background: #f9fafb; border-bottom: 1px solid #e5e7eb; font-size: 0.75rem; font-weight: 600; color: #6b7280;">
        Found ${items.length} result${items.length !== 1 ? 's' : ''}
    </div>`;

    Object.keys(grouped).forEach(category => {
        html += `<div style="padding: 0.5rem 1rem; background: #f3f4f6; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #6b7280; border-bottom: 1px solid #e5e7eb;">${category}</div>`;

        grouped[category].forEach(item => {
            html += `
                <a href="${item.url}" style="display: flex; align-items: center; padding: 0.75rem 1rem; gap: 0.75rem; text-decoration: none; color: inherit; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" 
                   onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                    ${item.image ? `
                        <div style="width: 40px; height: 40px; flex-shrink: 0; border-radius: 6px; overflow: hidden; background: #f3f4f6;">
                            <img src="${item.image}" alt="${item.title}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    ` : `
                        <div style="width: 40px; height: 40px; flex-shrink: 0; border-radius: 6px; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); display: flex; align-items: center; justify-content: center; font-weight: bold; color: #4f46e5; font-size: 0.875rem;">
                            ${(item.type || item.category || 'I').charAt(0)}
                        </div>
                    `}
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-weight: 600; font-size: 0.875rem; color: #111827; margin-bottom: 0.125rem;">${item.title}</div>
                        ${item.subtitle ? `<div style="font-size: 0.75rem; color: #6b7280;">${item.subtitle}</div>` : ''}
                    </div>
                    ${item.price ? `<div style="font-weight: 700; color: #4f46e5; font-size: 0.875rem;">${item.price}</div>` : ''}
                </a>
            `;
        });
    });

    container.innerHTML = html;
}



/* --- Form Validation (Visual) --- */
function initFormValidation() {
    const forms = document.querySelectorAll('form[novalidate]');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent actual submit for static demo
            let isValid = true;

            const inputs = form.querySelectorAll('input[required], textarea[required]');
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    setDetails(input, 'error');
                    isValid = false;
                } else {
                    setDetails(input, 'success');
                }
            });

            if (isValid) {
                alert('Form submitted successfully! (Static Demo)');
                form.reset();
                inputs.forEach(input => removeDetails(input));
            }
        });
    });
}

function setDetails(input, status) {
    input.classList.remove('border-green-500', 'border-red-500');
    if (status === 'error') {
        input.classList.add('border-red-500'); // Assuming utility class exists or style added
        input.style.borderColor = 'var(--color-error)';
    } else {
        input.classList.add('border-green-500');
        input.style.borderColor = 'var(--color-success)';
    }
}

function removeDetails(input) {
    input.style.borderColor = 'var(--color-border)';
}

/* --- Image Preview --- */
function initImagePreviews() {
    const fileInputs = document.querySelectorAll('input[type="file"][data-preview]');

    fileInputs.forEach(input => {
        input.addEventListener('change', function () {
            const targetId = this.getAttribute('data-preview');
            const targetEl = document.getElementById(targetId);

            if (this.files && this.files[0] && targetEl) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    targetEl.src = e.target.result;
                    targetEl.style.display = 'block';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
}
