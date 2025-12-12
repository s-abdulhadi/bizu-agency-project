@extends('layouts.admin')

@section('title', 'Order #' . $order->id . ' | Admin Panel')
@section('header', 'Order Details')

@section('content')
    <div class="mb-lg flex justify-between items-center">
        <div>
            <h2 class="mb-xs">Order #{{ $order->id }}</h2>
            <p class="text-light">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Orders
        </a>
    </div>

    @if(session('success'))
        <div class="mb-lg p-sm" style="background: #d1fae5; color: #065f46; border-radius: 0.375rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-2 gap-lg" style="grid-template-columns: 2fr 1fr;">
        <!-- Order Items -->
        <div class="card p-0" style="overflow-x: auto;">
            <div style="padding: 1rem; border-bottom: 1px solid var(--color-border); background: #f9fafb;">
                <h3 style="margin: 0; font-weight: 600;">Order Items</h3>
            </div>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; text-align: left; border-bottom: 1px solid var(--color-border);">
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">PRODUCT</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">PRICE</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">QTY</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr style="border-bottom: 1px solid var(--color-border);">
                            <td style="padding: 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    @if($item->product && $item->product->images)
                                        @php
                                            $images = $item->product->images;
                                            $imgSrc = is_array($images) && count($images) > 0 ? (Str::startsWith($images[0], 'http') ? $images[0] : asset('storage/' . $images[0])) : 'https://placehold.co/40';
                                        @endphp
                                        <img src="{{ $imgSrc }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div style="font-weight: 600;">{{ $item->product ? $item->product->name : 'Product #' . $item->product_id }}</div>
                                        @if(!$item->product)
                                            <div style="font-size: 0.75rem; color: var(--color-text-light);">Product data unavailable</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem;">${{ number_format($item->price, 2) }}</td>
                            <td style="padding: 1rem;">{{ $item->quantity }}</td>
                            <td style="padding: 1rem; font-weight: 600;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top: 2px solid var(--color-border);">
                        <td colspan="3" style="padding: 1rem; text-align: right; font-weight: 600;">Subtotal</td>
                        <td style="padding: 1rem; font-weight: 600;">${{ number_format($order->total_amount - $order->tax_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding: 1rem; text-align: right; font-weight: 600;">Tax (5%)</td>
                        <td style="padding: 1rem; font-weight: 600;">${{ number_format($order->tax_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding: 1rem; text-align: right; font-weight: 700; font-size: 1.125rem;">Total</td>
                        <td style="padding: 1rem; font-weight: 700; font-size: 1.125rem; color: var(--color-primary);">${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Sidebar -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Order Status -->
            <div class="card p-lg">
                <h3 style="margin: 0 0 1rem 0; font-weight: 600;">Order Status</h3>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.875rem;">Current Status</label>
                        <select name="status" style="width: 100%; padding: 0.5rem; border: 1px solid var(--color-border); border-radius: 0.375rem; background: white;">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Update Status</button>
                </form>
            </div>

            <!-- Customer Details -->
            <div class="card p-lg">
                <h3 style="margin: 0 0 1rem 0; font-weight: 600;">Customer Details</h3>
                <table style="width: 100%; border-spacing: 0 0.5rem;">
                    <tr>
                        <td style="font-weight: 600; color: var(--color-text-light); width: 80px;">Name:</td>
                        <td>{{ $order->customer_name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: var(--color-text-light);">Email:</td>
                        <td>{{ $order->customer_email }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: var(--color-text-light); vertical-align: top;">Address:</td>
                        <td>
                            @php $addr = json_decode($order->customer_address, true); @endphp
                            {{ $addr['address'] ?? '' }}<br>
                            {{ $addr['city'] ?? '' }}, {{ $addr['zip'] ?? '' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
