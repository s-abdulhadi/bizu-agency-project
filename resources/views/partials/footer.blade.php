<footer class="site-footer section-padding">
    <div class="container grid grid-4">
        <div class="footer-col">
            <a href="{{ url('/') }}" class="logo mb-lg" style="display: block;">
                <span
                    style="font-family: var(--font-heading); font-weight: 700; font-size: 1.5rem; color: var(--color-primary);">Bizu.</span>
            </a>
            <p class="text-light" style="font-size: 0.9rem; margin-bottom: 1rem;">
                We are a creative social media agency helping brands grow their voice and identity in the digital
                space.
            </p>
        </div>
        <div class="footer-col">
            <h4 class="mb-lg">Quick Links</h4>
            <ul class="flex flex-col gap-sm text-light">
                <li><a href="{{ url('/about') }}">About Us</a></li>
                <li><a href="{{ url('/services') }}">Services</a></li>
                <li><a href="{{ url('/portfolio') }}">Portfolio</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 class="mb-lg">Resources</h4>
            <ul class="flex flex-col gap-sm text-light">
                <li><a href="{{ url('/products') }}">Shop Products</a></li>
                <li><a href="{{ url('/testimonials') }}">Testimonials</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 class="mb-lg">Contact Info</h4>
            <ul class="flex flex-col gap-sm text-light" style="font-size: 0.9rem;">
                <li>📧 hello@bizu.agency</li>
                <li>📞 +1 (555) 123-4567</li>
                <li>📍 New York, NY 10012</li>
            </ul>
        </div>
    </div>
    <div class="container text-center mt-lg" style="border-top: 1px solid var(--color-border); padding-top: 2rem;">
        <p class="text-light" style="font-size: 0.875rem;">&copy; {{ date('Y') }} Bizu Agency. All rights reserved.</p>
    </div>
</footer>