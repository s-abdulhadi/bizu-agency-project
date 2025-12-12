@extends('layouts.app')

@section('title', 'Shop Resources | Bizu Agency')

@section('content')
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">Shop Resources</h1>
            <p class="text-light" style="max-width: 600px; margin: 0 auto;">Premium templates, presets, and guides to
                level up your social game.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">

            <!-- Category Filter -->
            <div class="flex justify-center gap-sm mb-lg flex-wrap">
                <a href="{{ url('/products') }}" class="btn btn-outline {{ !request('category') ? 'active' : '' }}"
                    style="{{ !request('category') ? 'background-color: var(--color-primary); color: white;' : '' }}">All
                    Products</a>
                @foreach($categories as $cat)
                    <a href="{{ url('/products?category=' . $cat->slug) }}"
                        class="btn btn-outline {{ request('category') == $cat->slug ? 'active' : '' }}"
                        style="{{ request('category') == $cat->slug ? 'background-color: var(--color-primary); color: white;' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div class="grid grid-3">
                @forelse($products as $product)
                    <div class="card" style="padding: 0; overflow: hidden;">
                        <img src="{{ (!empty($product->images) && isset($product->images[0])) ? (str_starts_with($product->images[0], 'http') ? $product->images[0] : asset('storage/' . $product->images[0])) : 'https://images.unsplash.com/photo-1616469829941-c7200edec809?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $product->name }}" style="width: 100%; height: 250px; object-fit: cover;">
                        <div style="padding: var(--spacing-md);">
                            <div class="flex justify-between items-center mb-sm">
                                <h3 style="font-size: 1.25rem; margin: 0;">{{ $product->name }}</h3>
                                <span class="font-bold text-primary">${{ $product->price }}</span>
                            </div>
                            <p class="text-light text-sm mb-md">{{ $product->short_description }}</p>
                            <a href="{{ url('/products/' . $product->slug) }}" class="btn btn-outline btn-sm"
                                style="width: 100%;">View Details</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center">
                        <p>No products available.</p>
                    </div>
                @endforelse
            </div>
            <!-- Pagination -->
            <div class="mt-lg">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection