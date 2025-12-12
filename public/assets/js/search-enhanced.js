/**
 * Enhanced Search Functionality with Category Filtering
 * Features: Ajax search, debouncing, category filter, loading state, keyboard navigation
 */

/* --- Search Dropdown (AJAX) --- */
function initSearch() {
    const searchInput = document.querySelector('.search-input');
    const searchResults = document.querySelector('.search-results');
    const categoryFilter = document.querySelector('.search-category');
    let searchTimeout;
    let currentRequest = null;

    if (!searchInput || !searchResults) return;

    // Search on input
    searchInput.addEventListener('input', (e) => {
        performSearch();
    });

    // Search on category change
    if (categoryFilter) {
        categoryFilter.addEventListener('change', () => {
            if (searchInput.value.length >= 2) {
                performSearch();
            }
        });
    }

    // Keyboard navigation
    searchInput.addEventListener('keydown', (e) => {
        const items = searchResults.querySelectorAll('.search-item');
        const active = searchResults.querySelector('.search-item.active');

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            if (!active) {
                items[0]?.classList.add('active');
            } else {
                active.classList.remove('active');
                const next = active.nextElementSibling;
                if (next && next.classList.contains('search-item')) {
                    next.classList.add('active');
                } else {
                    items[0]?.classList.add('active');
                }
            }
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            if (active) {
                active.classList.remove('active');
                const prev = active.previousElementSibling;
                if (prev && prev.classList.contains('search-item')) {
                    prev.classList.add('active');
                } else {
                    items[items.length - 1]?.classList.add('active');
                }
            }
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (active) {
                active.click();
            }
        } else if (e.key === 'Escape') {
            searchResults.style.display = 'none';
        }
    });

    function performSearch() {
        clearTimeout(searchTimeout);

        // Abort previous request if still pending
        if (currentRequest) {
            currentRequest.abort();
        }

        const query = searchInput.value;
        const category = categoryFilter ? categoryFilter.value : 'all';

        if (query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        // Show loading state
        searchResults.innerHTML = '<div class="p-3 text-center text-light"><div class="spinner"></div> Searching...</div>';
        searchResults.style.display = 'block';

        searchTimeout = setTimeout(() => {
            const controller = new AbortController();
            currentRequest = controller;

            fetch(`/ajax/search?query=${encodeURIComponent(query)}&category=${category}`, {
                signal: controller.signal
            })
                .then(response => response.json())
                .then(data => {
                    renderSearchResults(data, searchResults);
                    searchResults.style.display = 'block';
                    currentRequest = null;
                })
                .catch(error => {
                    if (error.name !== 'AbortError') {
                        console.error('Search error:', error);
                        searchResults.innerHTML = '<div class="p-3 text-center text-error">Error loading results</div>';
                    }
                });
        }, 200); // Reduced debounce for faster response
    }

    // Hide on click outside
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target) && (!categoryFilter || !categoryFilter.contains(e.target))) {
            searchResults.style.display = 'none';
        }
    });
}

function renderSearchResults(data, container) {
    const items = data.results || [];

    if (items.length === 0) {
        container.innerHTML = `
            <div class="p-4 text-center">
                <div style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem;">🔍</div>
                <div class="text-light">No results found for "${data.query}"</div>
            </div>
        `;
        return;
    }

    // Group results by category
    const grouped = {};
    items.forEach(item => {
        if (!grouped[item.category]) {
            grouped[item.category] = [];
        }
        grouped[item.category].push(item);
    });

    let html = '';

    // Add result count header
    html += `<div class="px-3 py-2 text-xs text-light border-b" style="background: #f9fafb; font-weight: 600;">
        Found ${items.length} result${items.length !== 1 ? 's' : ''}
    </div>`;

    // Render grouped results
    Object.keys(grouped).forEach(category => {
        html += `<div class="search-category-group">`;
        html += `<div class="px-3 py-1 text-xs font-bold text-light uppercase" style="background: #f3f4f6; border-bottom: 1px solid #e5e7eb;">${category}</div>`;

        grouped[category].forEach(item => {
            html += `
                <a href="${item.url}" class="search-item" style="display: flex; align-items: center; padding: 0.75rem 1rem; gap: 0.75rem; text-decoration: none; color: inherit; border-bottom: 1px solid #f3f4f6; transition: background-color 0.2s;">
                    ${item.image ? `
                        <div style="width: 40px; height: 40px; flex-shrink: 0; border-radius: 6px; overflow: hidden; background: #f3f4f6;">
                            <img src="${item.image}" alt="${item.title}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    ` : `
                        <div style="width: 40px; height: 40px; flex-shrink: 0; border-radius: 6px; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); display: flex; align-items: center; justify-content: center; font-weight: bold; color: #4f46e5; font-size: 0.875rem;">
                            ${item.type.charAt(0)}
                        </div>
                    `}
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-weight: 600; font-size: 0.875rem; color: #111827; margin-bottom: 0.125rem;">${item.title}</div>
                        ${item.subtitle ? `<div style="font-size: 0.75rem; color: #6b7280;">${item.subtitle}</div>` : ''}
                    </div>
                    ${item.price ? `<div style="font-weight: 700; color: var(--color-primary); font-size: 0.875rem;">${item.price}</div>` : ''}
                </a>
            `;
        });

        html += `</div>`;
    });

    container.innerHTML = html;

    // Add hover effects
    const searchItems = container.querySelectorAll('.search-item');
    searchItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            searchItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
}

// Add CSS for active state and spinner
const style = document.createElement('style');
style.textContent = `
    .search-item.active {
        background-color: #f9fafb !important;
    }
    .search-item:hover {
        background-color: #f9fafb !important;
    }
    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #e5e7eb;
        border-top-color: var(--color-primary);
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    mark {
        background-color: #fef08a;
        padding: 0 2px;
        border-radius: 2px;
        font-weight: 600;
    }
`;
document.head.appendChild(style);
