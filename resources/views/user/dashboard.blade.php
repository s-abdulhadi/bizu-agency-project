@extends('layouts.app')

@section('title', 'My Account')

@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="mb-lg">
                <h1 class="mb-xs">My Account</h1>
                <p class="text-light">Welcome back, {{ $user->name }}!</p>
            </div>

            <!-- Account Info Card -->
            <div class="card p-lg mb-lg">
                <h2 class="mb-md">Account Information</h2>
                <div class="grid grid-2 gap-md">
                    <div>
                        <p class="text-light mb-xs">Name</p>
                        <p class="font-bold">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-light mb-xs">Email</p>
                        <p class="font-bold">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-light mb-xs">Member Since</p>
                        <p class="font-bold">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-light mb-xs">Total Orders</p>
                        <p class="font-bold">{{ $orders->total() }}</p>
                    </div>
                </div>
            </div>

            <!-- Orders Section -->
            <div class="card p-0">
                <div style="padding: 1.5rem; border-bottom: 1px solid var(--color-border);">
                    <h2 style="margin: 0;">My Orders</h2>
                </div>

                @if($orders->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr
                                    style="background: #f9fafb; text-align: left; border-bottom: 1px solid var(--color-border);">
                                    <th
                                        style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                                        ORDER ID</th>
                                    <th
                                        style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                                        DATE</th>
                                    <th
                                        style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                                        TOTAL</th>
                                    <th
                                        style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                                        STATUS</th>
                                    <th
                                        style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                                        ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                                    <tr style="border-bottom: 1px solid var(--color-border);">
                                                        <td style="padding: 1rem; font-weight: 600;">#{{ $order->id }}</td>
                                                        <td style="padding: 1rem; color: var(--color-text-light);">
                                                            {{ $order->created_at->format('M d, Y') }}</td>
                                                        <td style="padding: 1rem; font-weight: 600;">${{ number_format($order->total_amount, 2) }}
                                                        </td>
                                                        <td style="padding: 1rem;">
                                                            @php
                                                                $statusColors = [
                                                                    'pending' => ['bg' => '#fef9c3', 'text' => '#854d0e'],
                                                                    'processing' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                                                    'completed' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                                                                    'cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                                                ];
                                                                $color = $statusColors[$order->status] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                                                            @endphp
                                     <span
                                                                style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize;">
                                                                {{ $order->status }}
                                                            </span>
                                                        </td>
                                                        <td style="padding: 1rem;">
                                                            <a href="{{ route('thankyou', $order->id) }}" class="btn btn-outline btn-sm">View
                                                                Details</a>
                                                        </td>
                                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($orders->hasPages())
                        <div style="padding: 1.5rem;">
                            {{ $orders->links() }}
                        </div>
                    @endif
                @else
                    <div style="padding: 4rem; text-align: center;">
                        <div style="margin-bottom: 1rem; font-size: 3rem; opacity: 0.3;">📦</div>
                        <h3 style="margin-bottom: 0.5rem;">No orders yet</h3>
                        <p class="text-light" style="margin-bottom: 1.5rem;">Start shopping to see your orders here!</p>
                        <a href="{{ url('/products') }}" class="btn btn-primary">Browse Products</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection