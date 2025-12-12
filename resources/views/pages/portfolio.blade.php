@extends('layouts.app')

@section('title', 'Portfolio | Bizu Agency')

@section('content')
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">Featured Work</h1>
            <p class="text-light" style="max-width: 600px; margin: 0 auto;">A collection of our best campaigns and
                creative projects.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <!-- Filter Controls (Server-Side) -->
            <div class="flex justify-center gap-sm mb-lg flex-wrap">
                <a href="{{ url('/portfolio') }}"
                    class="btn btn-outline filter-btn {{ request('service') ? '' : 'active' }}"
                    style="{{ !request('service') ? 'background-color: var(--color-primary); color: white; border-color: var(--color-primary);' : '' }}">All
                    Work</a>
                @foreach($services as $service)
                    <a href="{{ url('/portfolio?service=' . $service->slug) }}"
                        class="btn btn-outline filter-btn {{ request('service') == $service->slug ? 'active' : '' }}"
                        style="{{ request('service') == $service->slug ? 'background-color: var(--color-primary); color: white; border-color: var(--color-primary);' : '' }}">
                        {{ $service->title }}
                    </a>
                @endforeach
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-3 portfolio-grid">
                @forelse($portfolios as $item)
                    <div class="card portfolio-item flex flex-col" style="padding: 0; overflow: hidden; height: 100%;">
                        <img src="{{ $item->cover_image ? (str_starts_with($item->cover_image, 'http') ? $item->cover_image : asset('storage/' . $item->cover_image)) : 'https://images.unsplash.com/photo-1600607686527-6fb886090705?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $item->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="flex flex-col flex-grow-1 justify-between"
                            style="padding: var(--spacing-md); height: 100%;">
                            <div>
                                <div class="text-xs text-primary font-bold mb-xs">{{ $item->service->title ?? 'PROJECT' }}</div>
                                <h3 style="font-size: 1.25rem;">{{ $item->title }}</h3>
                                <p class="text-light text-sm mb-md">{{ $item->description }}</p>
                            </div>
                            <a href="{{ url('/portfolio/' . $item->slug) }}" class="btn btn-outline btn-sm"
                                style="width: 100%;">View Project</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center">
                        <p>No projects found in this category.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-lg">
                {{ $portfolios->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection