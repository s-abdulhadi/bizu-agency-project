@extends('layouts.app')

@section('title', $portfolio->title . ' | Bizu Agency')

@section('content')
    <!-- Project Hero -->
    <section class="section-padding" style="padding-bottom: 0;">
        <div class="container">
            <div class="mb-lg">
                <a href="{{ url('/portfolio') }}" class="text-light hover:text-primary">&larr; Back to Portfolio</a>
            </div>
            <h1 class="mb-md">{{ $portfolio->title }}</h1>
            <p class="text-light mb-lg project-desc" style="font-size: 1.25rem; max-width: 800px;">
                {{ $portfolio->client_name }}
            </p>
        </div>
        <img src="{{ str_starts_with($portfolio->cover_image, 'http') ? $portfolio->cover_image : asset('storage/' . $portfolio->cover_image) }}"
            alt="{{ $portfolio->title }}" class="hero-img"
            style="width: 100%; height: 500px; object-fit: cover; display: block; border-radius: var(--radius-lg); box-shadow: var(--shadow-card);">
    </section>

    <!-- Project Info -->
    <section class="section-padding"
        style="background-color: var(--color-surface); margin-top: -80px; position: relative; z-index: 10; width: 90%; margin-left: auto; margin-right: auto; border-radius: var(--radius-lg); box-shadow: var(--shadow-card);">
        <div class="container grid grid-3">
            <div>
                <h4 class="text-light text-sm uppercase mb-xs">Client</h4>
                <p class="font-bold client-name">{{ $portfolio->client_name }}</p>
            </div>
            <div>
                <h4 class="text-light text-sm uppercase mb-xs">Service</h4>
                <p class="font-bold category-name">{{ $portfolio->service->title ?? 'N/A' }}</p>
            </div>
            <div>
                <h4 class="text-light text-sm uppercase mb-xs">Date</h4>
                <p class="font-bold">{{ $portfolio->created_at->format('F Y') }}</p>
            </div>
        </div>
    </section>

    <!-- Case Study Content -->
    <section class="section-padding">
        <div class="container grid grid-2 gap-lg">
            <div>
                <h2 class="mb-md">Project Details</h2>
                <div class="text-light mb-lg">
                    {!! nl2br(e($portfolio->description)) !!}
                </div>
            </div>
            <div>
                @if($portfolio->images && count($portfolio->images) > 0)
                    @foreach($portfolio->images as $img)
                        <img src="{{ str_starts_with($img, 'http') ? $img : asset('storage/' . $img) }}" alt="Detail"
                            style="border-radius: var(--radius-lg); margin-bottom: var(--spacing-md); width: 100%;">
                    @endforeach
                @else
                    <img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Detail 1" style="border-radius: var(--radius-lg); margin-bottom: var(--spacing-md); width: 100%;">
                @endif
            </div>
        </div>
    </section>
@endsection