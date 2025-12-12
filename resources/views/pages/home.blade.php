@extends('layouts.app')

@section('title', 'Bizu Agency | Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero section-padding">
        <div class="container grid grid-2 items-center">
            <div class="hero-content">
                <h1 class="mb-lg">We Craft Digital Experiences That <span class="text-primary">Connect.</span></h1>
                <p class="text-light mb-lg" style="font-size: 1.25rem;">
                    Bizu is a full-service social media agency helping brands find their voice, grow their audience, and
                    drive real results.
                </p>
                <div class="flex gap-sm">
                    <a href="{{ url('/services') }}" class="btn btn-primary">Our Services</a>
                    <a href="{{ url('/portfolio') }}" class="btn btn-outline">View Work</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Creative Agency Team" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-hover);">
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="section-padding" style="background-color: white;">
        <div class="container">
            <div class="flex justify-between items-center mb-lg">
                <h2>Our Expertise</h2>
                <a href="{{ url('/services') }}" class="text-primary font-bold">View All &rarr;</a>
            </div>
            <div class="grid grid-3">
                @forelse($services as $service)
                    <div class="card">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">
                            @if($service->icon) <img
                                src="{{ str_starts_with($service->icon, 'http') ? $service->icon : asset('storage/' . $service->icon) }}"
                            alt="Icon" width="40"> @else
                                🚀 @endif
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p class="text-light mb-lg">{{ $service->short_description }}</p>
                        <a href="{{ url('/services/' . $service->slug) }}" class="text-primary font-bold">Learn More</a>
                    </div>
                @empty
                    <!-- Fallback content if no DB records -->
                    <div class="card">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">🚀</div>
                        <h3>Social Strategy</h3>
                        <p class="text-light mb-lg">Data-driven roadmaps to grow your brand across all platforms.</p>
                        <a href="{{ url('/services') }}" class="text-primary font-bold">View Services</a>
                    </div>
                    <!-- ... other fallbacks ... -->
                @endforelse
            </div>
        </div>
    </section>

    <!-- Portfolio Preview -->
    <section class="section-padding">
        <div class="container">
            <div class="flex justify-between items-center mb-lg">
                <h2>Recent Work</h2>
                <a href="{{ url('/portfolio') }}" class="text-primary font-bold">View Portfolio &rarr;</a>
            </div>
            <div class="grid grid-2">
                @forelse($portfolios as $item)
                    <div class="card" style="padding: 0; overflow: hidden;">
                        <img src="{{ $item->cover_image ? (str_starts_with($item->cover_image, 'http') ? $item->cover_image : asset('storage/' . $item->cover_image)) : 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $item->title }}" style="width: 100%; height: 300px; object-fit: cover;">
                        <div style="padding: var(--spacing-md);">
                            <h3>{{ $item->title }}</h3>
                            <p class="text-light">{{ $item->client_name }}</p>
                        </div>
                    </div>
                @empty
                    <div class="card" style="padding: 0; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Project 1" style="width: 100%; height: 300px; object-fit: cover;">
                        <div style="padding: var(--spacing-md);">
                            <h3>TechStart Rebrand</h3>
                            <p class="text-light">Brand Identity, Social Media</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-padding"
        style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%); color: white; text-align: center;">
        <div class="container">
            <h2 style="color: white; margin-bottom: 1rem;">Ready to Elevate Your Brand?</h2>
            <p style="margin-bottom: 2rem; opacity: 0.9;">Join hundreds of satisfied clients who have transformed their
                digital presence.</p>
            <a href="{{ url('/contact') }}" class="btn" style="background: white; color: var(--color-primary);">Get Started
                Today</a>
        </div>
    </section>
@endsection