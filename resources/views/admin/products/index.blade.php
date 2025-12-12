@extends('layouts.admin')

@section('title', 'Products | Admin Panel')
@section('header', 'Products Management')

@section('content')
    <div class="mb-lg flex justify-between items-center">
        <div>
            <h2 class="mb-xs">Products</h2>
            <p class="text-light">Manage your product catalog</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Product
        </a>
    </div>

    <div class="card p-0" style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left; border-bottom: 1px solid var(--color-border);">
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">ID</th>
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">IMAGE</th>
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">TITLE</th>
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">TYPE</th>
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">CATEGORY/DESC</th>
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">PRICE</th>
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">CREATED</th>
                    <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    @php
                        // Image Logic
                        $imgSrc = 'https://placehold.co/50';
                        $images = $product->images;
                        $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                        if ($firstImage) {
                            $imgSrc = Str::startsWith($firstImage, 'http') ? $firstImage : asset('storage/' . $firstImage);
                        }
                    @endphp
                    <tr style="border-bottom: 1px solid var(--color-border);">
                        <td style="padding: 1rem; font-weight: 600;">#{{ $product->id }}</td>
                        <td style="padding: 1rem;">
                            <img src="{{ $imgSrc }}" alt="{{ $product->name }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 0.375rem;">
                        </td>
                        <td style="padding: 1rem; font-weight: 600;">{{ $product->name }}</td>
                        <td style="padding: 1rem;">
                            <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700;">PRODUCT</span>
                        </td>
                        <td style="padding: 1rem;">
                            <span style="background: #f3f4f6; color: #374151; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">
                                {{ $product->category ? $product->category->name : 'Uncategorized' }}
                            </span>
                        </td>
                        <td style="padding: 1rem; font-weight: 600; color: var(--color-primary);">${{ number_format($product->price, 2) }}</td>
                        <td style="padding: 1rem; color: var(--color-text-light);">{{ $product->created_at->format('M d, Y') }}</td>
                        <td style="padding: 1rem;">
                            <div class="flex gap-xs">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline" style="padding: 0.25rem 0.5rem; border-color: var(--color-primary); color: var(--color-primary);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="padding: 0.25rem 0.5rem; border-color: var(--color-error); color: var(--color-error);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 3rem;">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="mt-lg">
            {{ $products->links() }}
        </div>
    @endif
@endsection
