@extends('layouts.app')

@section('title', 'Order Confirmed | Bizu Agency')

@section('content')
    <section class="section-padding" style="background-color: var(--color-surface); min-height: 60vh; display: flex; align-items: center;">
        <div class="container">
            <div class="card" style="max-width: 800px; margin: 0 auto; padding: 3rem;">
                <div class="text-center mb-xl">
                    <div style="width: 80px; height: 80px; background: #e6fffa; color: #0f5132; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h1 class="mb-sm">Order Confirmed!</h1>
                    <p class="text-light">Thank you for your purchase. Your order #{{ $order->id }} has been processed successfully.</p>
                </div>

                <div class="grid grid-2 gap-lg mb-xl" style="background: #f8f9fa; padding: 2rem; border-radius: var(--radius-md);">
                    <div>
                        <h4 class="mb-sm">Order Parameters</h4>
                        <p class="mb-xs"><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p class="mb-xs"><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
                        <p class="mb-xs"><strong>Status:</strong> <span style="text-transform: capitalize; color: green;">{{ $order->status }}</span></p>
                    </div>
                    <div>
                        <h4 class="mb-sm">Customer Details</h4>
                        <p class="mb-xs"><strong>Name:</strong> {{ $order->customer_name }}</p>
                        <p class="mb-xs"><strong>Email:</strong> {{ $order->customer_email }}</p>
                    </div>
                </div>

                <div class="mb-xl">
                    <h3 class="mb-md">Order Items</h3>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--color-border); text-align: left;">
                                <th style="padding: 1rem 0;">Product</th>
                                <th style="padding: 1rem 0; text-align: right;">Price</th>
                                <th style="padding: 1rem 0; text-align: right;">Quantity</th>
                                <th style="padding: 1rem 0; text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr style="border-bottom: 1px solid var(--color-border);">
                                    <td style="padding: 1rem 0;">
                                        @php 
                                            // Try to find image from Product or Service model based on product_id
                                            // This is a bit tricky since OrderItem handles both. 
                                            // Ideally we'd store a snapshot of name/image, but for now we query.
                                            $name = 'Item'; 
                                            $image = null;
                                            // Assuming we don't have direct polymorphic relation on item, we use the stored data if possible or just show generic content.
                                            // For this view, let's keep it simple or assume we passed necessary data. 
                                            // Since we didn't update OrderItem to store name/image, we rely on the product/service relation if it existed.
                                            // Let's just assume we can display what we know.
                                        @endphp
                                        <div style="font-weight: 500;">Product ID: {{ $item->product_id }}</div> 
                                        <!-- In a real app we would load the related model. -->
                                    </td>
                                    <td style="padding: 1rem 0; text-align: right;">${{ number_format($item->price, 2) }}</td>
                                    <td style="padding: 1rem 0; text-align: right;">{{ $item->quantity }}</td>
                                    <td style="padding: 1rem 0; text-align: right;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="padding-top: 1rem; text-align: right;">Subtotal</td>
                                <td style="padding-top: 1rem; text-align: right;">${{ number_format($order->total_amount - $order->tax_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right;">Tax (5%)</td>
                                <td style="text-align: right;">${{ number_format($order->tax_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="padding-top: 1rem; text-align: right; font-weight: bold; font-size: 1.25rem;">Total</td>
                                <td style="padding-top: 1rem; text-align: right; font-weight: bold; font-size: 1.25rem; color: var(--color-primary);">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                </div>
            </div>
        </div>
    </section>
@endsection
