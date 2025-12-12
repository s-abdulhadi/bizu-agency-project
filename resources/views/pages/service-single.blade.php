@extends('layouts.app')

@section('title', $service->title . ' | Bizu Agency')

@section('content')
    <!-- Service Hero -->
    <section class="section-padding" style="background-color: var(--color-surface);">
        <div class="container grid grid-2 items-center">
            <div>
                <h1 class="mb-md">{{ $service->title }}</h1>
                <p class="text-light mb-lg" style="font-size: 1.25rem;">{{ $service->short_description }}</p>
                <div class="mb-lg text-light">
                    {!! nl2br(e($service->long_description)) !!}
                </div>
                <!-- 
                                <div class="mb-lg">
                                    <span class="font-bold text-primary" style="font-size: 1.5rem;">$999/mo</span>
                                </div>
                                -->
                <div class="flex gap-sm items-center">
                    <form action="{{ route('cart.add', ['type' => 'service', 'id' => $service->id]) }}" method="POST"
                        class="flex gap-sm add-to-cart-form">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" class="form-input" style="width: 80px;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    <!-- <a href="{{ url('/contact?service=' . $service->slug) }}" class="btn btn-outline">Enquire Only</a> -->
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-md"
                        style="color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: 10px; border-radius: 5px;">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div>
                @if($service->icon)
                    <img src="{{ str_starts_with($service->icon, 'http') ? $service->icon : asset('storage/' . $service->icon) }}"
                        alt="{{ $service->title }}"
                        style="border-radius: var(--radius-lg); box-shadow: var(--shadow-card); width: 100%; max-height: 400px; object-fit: cover;">
                @else
                    <div
                        style="background: var(--color-primary); width: 100%; height: 300px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem;">
                        {{ substr($service->title, 0, 1) }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer is auto-included -->
@endsection