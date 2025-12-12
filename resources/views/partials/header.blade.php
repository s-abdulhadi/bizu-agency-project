<header class="site-header">
    <div class="container flex justify-between items-center">
        <a href="{{ url('/') }}" class="logo">
            <span style="font-family: var(--font-heading); font-weight: 700; font-size: 1.625rem; color: var(--color-primary);">Bizu.</span>
        </a>
        
        <nav class="nav-links">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
            <a href="{{ url('/services') }}" class="nav-link {{ request()->is('services*') ? 'active' : '' }}">Services</a>
            <a href="{{ url('/portfolio') }}" class="nav-link {{ request()->is('portfolio*') ? 'active' : '' }}">Portfolio</a>
            <a href="{{ url('/products') }}" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">Products</a>
            <a href="{{ url('/testimonials') }}" class="nav-link {{ request()->is('testimonials') ? 'active' : '' }}">Testimonials</a>
            <a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        </nav>
        
        <div class="header-utils">
            <!-- Search Bar -->
            <div class="search-container">
                <div class="search-box">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search...">
                    <select class="search-category">
                        <option value="all">All</option>
                        <option value="services">Services</option>
                        <option value="portfolio">Portfolio</option>
                        <option value="products">Products</option>
                    </select>
                </div>
                <div class="search-results"></div>
            </div>

            <!-- Cart -->
            <a href="{{ url('/cart') }}" class="icon-btn cart-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                @php 
                    $cart = session('cart', []);
                    $cartCount = is_array($cart) ? array_sum(array_column($cart, 'quantity')) : 0;
                @endphp
                @if($cartCount > 0)
                    <span class="badge">{{ $cartCount }}</span>
                @endif
            </a>

            <!-- Auth Buttons -->
            @auth
                <div class="auth-buttons">
                    @if(auth()->user()->is_admin)
                        <a href="{{ url('/admin') }}" class="btn btn-outline btn-sm">Admin</a>
                    @else
                        <a href="{{ url('/account') }}" class="btn btn-outline btn-sm">My Account</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                    </form>
                </div>
            @else
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
                </div>
            @endauth

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>
</header>

<style>
/* ========================================
   MODERN NAVBAR REDESIGN
   Clean, spacious, and premium aesthetic
   ======================================== */

/* Header Container */
.site-header {
    background: white;
    border-bottom: 1px solid #e5e7eb;
    padding: 1.25rem 0; /* Increased from 1rem for more airy feel */
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05); /* Softer shadow */
}

.site-header .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem; /* Minimal gap to save space */
}

/* Logo Branding */
.logo {
    padding-left: 0; /* Remove extra padding */
    text-decoration: none;
    display: flex;
    align-items: center;
    flex-shrink: 0; /* Prevent logo from shrinking */
}

.logo span {
    font-size: 1.625rem !important; /* Slightly larger for better visual weight */
    letter-spacing: -0.02em; /* Tighter letter spacing for modern look */
}

/* Navigation Links */
.nav-links {
    display: flex;
    gap: 1rem; /* Balanced spacing to prevent overflow */
    align-items: center;
}

.nav-link {
    padding: 0.5rem 0.75rem; /* More compact */
    color: #6b7280;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9375rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
    position: relative;
    white-space: nowrap; /* Prevent wrapping */
}

.nav-link:hover {
    color: #374151;
    background: #f9fafb; /* Lighter hover background */
}

/* Active Link - Modern Indicator */
.nav-link.active {
    color: var(--color-primary);
    background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%); /* Subtle gradient */
    font-weight: 600;
}

/* Header Utilities */
.header-utils {
    display: flex;
    align-items: center;
    gap: 0.75rem; /* Compact spacing */
    flex-shrink: 0; /* Prevent utilities from shrinking */
}

/* ========================================
   SEARCH BAR - Compact & Sleek
   ======================================== */
.search-container {
    position: relative;
}

.search-box {
    display: flex;
    align-items: center;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 0.625rem;
    padding: 0.5rem 0.625rem; /* Compact */
    gap: 0.5rem;
    transition: all 0.2s ease;
    min-width: 220px; /* Smaller to save space */
}

.search-box:focus-within {
    background: white;
    border-color: #6366f1; /* Softer blue tone */
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.search-icon {
    color: #9ca3af;
    flex-shrink: 0;
}

.search-input {
    border: none;
    background: transparent;
    outline: none;
    flex: 1;
    font-size: 0.875rem;
    color: #111827;
    padding: 0; /* Remove extra padding */
}

.search-input::placeholder {
    color: #9ca3af;
}

.search-category {
    border: none;
    background: transparent;
    outline: none;
    font-size: 0.8125rem;
    color: #6b7280;
    cursor: pointer;
    padding: 0.25rem 0.5rem;
    border-left: 1px solid #e5e7eb;
    margin-left: 0.5rem;
    padding-left: 0.75rem; /* Better alignment */
}

.search-results {
    display: none;
    position: absolute;
    top: calc(100% + 0.5rem);
    right: 0;
    width: 420px;
    max-width: 90vw;
    max-height: 500px;
    overflow-y: auto;
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    z-index: 1001;
}

/* ========================================
   ICONS & BUTTONS - Modern & Spacious
   ======================================== */

/* Icon Button (Cart) */
.icon-btn {
    position: relative;
    width: 44px; /* Slightly larger for better touch target */
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.625rem; /* More rounded */
    color: #6b7280;
    transition: all 0.2s ease;
    text-decoration: none;
}

.icon-btn:hover {
    background: #f3f4f6;
    color: var(--color-primary);
    transform: translateY(-1px); /* Subtle lift effect */
}

.icon-btn .badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #ef4444;
    color: white;
    font-size: 0.6875rem;
    font-weight: 700;
    padding: 0.125rem 0.375rem;
    border-radius: 9999px;
    min-width: 18px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3); /* Subtle shadow */
}

/* Auth Buttons */
.auth-buttons {
    display: flex;
    gap: 0.5rem; /* Compact spacing */
    align-items: center;
}

.btn-sm {
    padding: 0.5rem 1rem; /* Compact padding to fit navbar */
    font-size: 0.875rem;
    font-weight: 500;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-outline {
    border: 1.5px solid #e5e7eb;
    color: #374151;
    background: white;
}

.btn-outline:hover {
    border-color: #6366f1; /* Softer blue */
    color: #6366f1;
    background: #f9fafb;
    transform: translateY(-1px);
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); /* Softer blue gradient */
    color: white;
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    transform: translateY(-1px);
}

/* Mobile Menu Button */
.mobile-menu-btn {
    display: none;
    width: 44px;
    height: 44px;
    align-items: center;
    justify-content: center;
    border: none;
    background: transparent;
    color: #6b7280;
    cursor: pointer;
    border-radius: 0.625rem;
    transition: all 0.2s ease;
}

.mobile-menu-btn:hover {
    background: #f3f4f6;
    color: var(--color-primary);
}

/* ========================================
   RESPONSIVE DESIGN
   ======================================== */
@media (max-width: 1024px) {
    .nav-links {
        display: none;
    }
    
    .mobile-menu-btn {
        display: flex;
    }
    
    .search-box {
        min-width: 200px;
    }
    
    .search-input {
        width: 100px;
    }
    
    .header-utils {
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .site-header {
        padding: 1rem 0;
    }
    
    .site-header .container {
        gap: 1.5rem;
    }
    
    .search-box {
        min-width: 160px;
        padding: 0.5rem 0.75rem;
    }
    
    .search-category {
        display: none; /* Hide category on mobile */
    }
}

@media (max-width: 640px) {
    .auth-buttons .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.8125rem;
    }
    
    .search-box {
        min-width: 140px;
        padding: 0.5rem 0.625rem;
    }
    
    .search-input {
        width: 80px;
    }
    
    .header-utils {
        gap: 0.75rem;
    }
}
</style>
