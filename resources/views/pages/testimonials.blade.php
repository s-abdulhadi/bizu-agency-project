@extends('layouts.app')

@section('title', 'Client Testimonials | Bizu Agency')

@section('content')
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">Client Love</h1>
            <p class="text-light" style="max-width: 600px; margin: 0 auto;">Don't just take our word for it. Here's what our partners say.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="grid grid-3">
                @forelse($testimonials as $testimonial)
                    <div class="card testimonial-card">
                        <div class="flex items-center gap-md mb-md">
                            @if($testimonial->avatar)
                                <img src="{{ str_starts_with($testimonial->avatar, 'http') ? $testimonial->avatar : asset('storage/' . $testimonial->avatar) }}" 
                                     alt="{{ $testimonial->client_name }}" 
                                     style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--color-primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.25rem;">
                                    {{ substr($testimonial->client_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 style="margin: 0;">{{ $testimonial->client_name }}</h4>
                                <span class="text-xs text-light">{{ $testimonial->company ?? 'Client' }}</span>
                            </div>
                        </div>
                        <p class="text-light" style="font-style: italic;">"{{ $testimonial->quote }}"</p>
                    </div>
                @empty
                    <div class="col-span-3 text-center">
                        <p>No testimonials yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
