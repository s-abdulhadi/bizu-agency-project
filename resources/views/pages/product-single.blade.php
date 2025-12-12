@extends('layouts.app')

@section('title', $product->name . ' | Bizu Agency')

@section('content')
    <section class="section-padding" style="background-color: var(--color-surface);">
        <div class="container grid grid-2 items-center">
            <div class="product-image">
                @php $images = $product->images ?? []; @endphp
                <img src="{{ (!empty($images) && count($images) > 0) ? (str_starts_with($images[0], 'http') ? $images[0] : asset('storage/' . $images[0])) : 'https://images.unsplash.com/photo-1616469829941-c7200edec809?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                    alt="{{ $product->name }}"
                    style="border-radius: var(--radius-lg); box-shadow: var(--shadow-card); width: 100%;">
            </div>
            <div class="product-details">
                <div class="text-xs text-primary font-bold mb-xs uppercase">{{ $product->category->name ?? 'Product' }}
                </div>
                <h1 class="mb-sm">{{ $product->name }}</h1>
                <div class="text-xl font-bold mb-md">${{ $product->price }}</div>
                <p class="text-light mb-lg">{{ $product->short_description }}</p>
                <div class="mb-lg text-light">
                    {!! nl2br(e($product->full_description)) !!}
                </div>

                <form action="{{ route('cart.add', ['type' => 'product', 'id' => $product->id]) }}" method="POST"
                    class="flex gap-sm add-to-cart-form">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" class="form-input" style="width: 80px;">
                    <button type="submit" class="btn btn-primary flex-grow-1">Add to Cart</button>
                </form>
            </div>
        </div>
    </section>
@endsection