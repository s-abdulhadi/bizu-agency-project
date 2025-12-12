/**
 * Bizu Agency - Main JS
 * Functionality: Mobile menu, search, cart simulation, form validation.
 */

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initSearch();
    updateCartBadge();
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
function initSearch() {
    const searchInput = document.querySelector('.search-input');
    const searchResults = document.querySelector('.search-results');

    if (!searchInput || !searchResults) return;

    searchInput.addEventListener('keyup', (e) => {
        const query = e.target.value.toLowerCase();

        if (query.length > 2) {
            // Mock server response
            const mockData = [
                { title: 'Social Media Management', url: 'service-single.html', type: 'Service' },
                { title: 'Branding Kit', url: 'service-single.html', type: 'Product' },
                { title: 'SEO Audit', url: 'service-single.html', type: 'Service' }
            ];

            const filtered = mockData.filter(item => item.title.toLowerCase().includes(query));
            renderSearchResults(filtered, searchResults);
            searchResults.style.display = 'block';
        } else {
            searchResults.style.display = 'none';
        }
    });

    // Hide on click outside
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });
}

function renderSearchResults(items, container) {
    if (items.length === 0) {
        container.innerHTML = '<div class="p-2 text-light">No results found.</div>';
        return;
    }

    const html = items.map(item => `
        <a href="${item.url}" class="search-item block p-2 hover:bg-gray-100">
            <div class="font-bold text-sm">${item.title}</div>
            <div class="text-xs text-light">${item.type}</div>
        </a>
    `).join('');

    container.innerHTML = html;
}

/* --- Cart Badge (Mock) --- */
function updateCartBadge() {
    const badge = document.querySelector('.cart-badge');
    if (badge) {
        // Mock simple count, in real app check localStorage or API
        const count = 3;
        badge.textContent = count;
        badge.style.display = count > 0 ? 'block' : 'none';
    }
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
