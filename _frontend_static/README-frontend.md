# Bizu Agency - Static Frontend

This folder contains the specific static HTML/CSS/JS build for the Bizu Agency website. The code is modular, responsive, and ready for Laravel Blade integration.

## Folder Structure
```
/frontend
  /assets
    /css/styles.css      # Global styles, variables, utilities
    /js/main.js          # Core JS (Mobile menu, search, validation, preview)
    /img/                # (Placeholder for local images)
  /partials
    _header.html         # Navbar (HTML snippet)
    _footer.html         # Footer (HTML snippet)
  index.html             # Homepage
  about.html             # About Us
  services.html          # Services List
  service-single.html    # Service Detail
  portfolio.html         # Portfolio List (with JS filtering)
  portfolio-single.html  # Project Detail
  products.html          # Shop List
  product-single.html    # Product Detail
  cart.html              # Shopping Cart
  checkout.html          # Checkout Flow
  contact.html           # Contact Form
  testimonials.html      # Client Reviews
  auth-login.html        # Login Page
  auth-signup.html       # Sign Up Page
  
  # Admin Mockups
  admin-services-list.html
  admin-service-form.html
  admin-portfolio-list.html
  admin-portfolio-form.html
  admin-products-list.html
  admin-product-form.html
```

## How to Preview
Simply open any `.html` file in your web browser. No server is required.
Example: Double-click `index.html`.

## Integration Notes
- **Partials**: The `_header.html` and `_footer.html` files contain the exact HTML code used in the public pages. When moving to Laravel, copy these into your Blade layout file (e.g., `layouts/app.blade.php`).
- **Dynamic Content**:
    - **Search**: The search bar currently uses a mock JSON array in `main.js`. Connect this to your backend API endpoint.
    - **Forms**: All forms have `novalidate` to prevent browser defaults, relying on the custom JS validation in `main.js`. Update `action="#"` to your real routes.
    - **Image Preview**: File inputs with `data-preview="id"` will automatically show the selected image in the `<img>` element with that ID.

## Assets & Credits
- **Fonts**: 'Outfit' (Google Fonts).
- **Images**: Unsplash (Hotlinked via Source URL for development).
    - Queries used: `marketing`, `office`, `creative`, `technology`, `design`.
