@extends('layouts.app')

@section('title', 'Our Services | Bizu Agency')

@section('content')
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">Our Expertise</h1>
            <p class="text-light" style="max-width: 600px; margin: 0 auto;">Comprehensive solutions to elevate your
                brand presence.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container grid grid-3">
            @forelse($services as $service)
                <div class="card">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">
                        @if($service->icon)
                            <img src="{{ Str::startsWith($service->icon, 'http') ? $service->icon : asset('storage/' . $service->icon) }}"
                                alt="Icon" width="40">
                        @else 🚀
                        @endif
                    </div>
                    <h3>{{ $service->title }}</h3>
                    <p class="text-light mb-lg">{{ $service->short_description }}</p>
                    <div class="mb-md text-primary font-bold">Details Inside</div>
                    <div class="flex gap-sm">
                        <a href="{{ url('/services/' . $service->slug) }}" class="btn btn-primary btn-sm">Details</a>
                    </div>
                </div>
            @empty
                <div class="container text-center">
                    <p>No services found.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection