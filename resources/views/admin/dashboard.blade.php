@extends('layouts.admin')

@section('title', 'Dashboard | Admin Panel')
@section('header', 'Dashboard')

@section('content')
    <div class="mb-lg">
        <h2 class="mb-xs">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="text-light">Here's what's happening with your business today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-4 gap-lg mb-xl"
        style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
        <!-- Total Orders -->
        <div class="card p-lg"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Total Orders</p>
                    <h3 style="margin: 0.5rem 0 0 0; font-size: 2rem; font-weight: 700;">{{ $totalOrders }}</h3>
                </div>
                <div
                    style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
            </div>
            <p style="margin: 0; font-size: 0.75rem; opacity: 0.8;">All time orders</p>
        </div>

        <!-- Total Revenue -->
        <div class="card p-lg"
            style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Total Revenue</p>
                    <h3 style="margin: 0.5rem 0 0 0; font-size: 2rem; font-weight: 700;">
                        ${{ number_format($totalRevenue, 0) }}</h3>
                </div>
                <div
                    style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
            </div>
            <p style="margin: 0; font-size: 0.75rem; opacity: 0.8;">Excluding cancelled orders</p>
        </div>

        <!-- Total Users -->
        <div class="card p-lg"
            style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Total Users</p>
                    <h3 style="margin: 0.5rem 0 0 0; font-size: 2rem; font-weight: 700;">{{ $totalUsers }}</h3>
                </div>
                <div
                    style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <p style="margin: 0; font-size: 0.75rem; opacity: 0.8;">Registered customers</p>
        </div>

        <!-- Pending Orders -->
        <div class="card p-lg"
            style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Pending Orders</p>
                    <h3 style="margin: 0.5rem 0 0 0; font-size: 2rem; font-weight: 700;">{{ $pendingOrders }}</h3>
                </div>
                <div
                    style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
            </div>
            <p style="margin: 0; font-size: 0.75rem; opacity: 0.8;">Needs attention</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-2 gap-lg" style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">

        <!-- Recent Orders -->
        <div class="card p-0" style="overflow-x: auto;">
            <div
                style="padding: 1rem; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-weight: 600;">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline"
                    style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">View All</a>
            </div>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; text-align: left; border-bottom: 1px solid var(--color-border);">
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">ID
                        </th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                            CUSTOMER</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                            DATE</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                            TOTAL</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                            STATUS</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem; font-weight: 600;">
                            ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr style="border-bottom: 1px solid var(--color-border);">
                            <td style="padding: 1rem; font-weight: 600;">#{{ $order->id }}</td>
                            <td style="padding: 1rem;">
                                {{ $order->customer_name }}<br>
                                <span
                                    style="font-size: 0.75rem; color: var(--color-text-light);">{{ $order->customer_email }}</span>
                            </td>
                            <td style="padding: 1rem; color: var(--color-text-light);">
                                {{ $order->created_at->format('M d, Y') }}</td>
                            <td style="padding: 1rem; font-weight: 600;">${{ number_format($order->total_amount, 2) }}</td>
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
                                    style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize;">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline"
                                    style="padding: 0.25rem 0.75rem; border-color: var(--color-primary); color: var(--color-primary); font-size: 0.875rem;">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center" style="padding: 3rem;">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Sidebar -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">

            <!-- Order Status Breakdown -->
            <div class="card p-lg">
                <h3 style="margin: 0 0 1rem 0; font-weight: 600;">Order Status</h3>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    @foreach($ordersByStatus as $status => $count)
                        @php
                            $statusInfo = [
                                'pending' => ['color' => '#f59e0b', 'label' => 'Pending'],
                                'processing' => ['color' => '#3b82f6', 'label' => 'Processing'],
                                'completed' => ['color' => '#10b981', 'label' => 'Completed'],
                                'cancelled' => ['color' => '#ef4444', 'label' => 'Cancelled'],
                            ];
                            $info = $statusInfo[$status];
                            $percentage = $totalOrders > 0 ? ($count / $totalOrders) * 100 : 0;
                        @endphp
                        <div>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                                <span style="font-size: 0.875rem; font-weight: 500;">{{ $info['label'] }}</span>
                                <span style="font-size: 0.875rem; font-weight: 600;">{{ $count }}</span>
                            </div>
                            <div
                                style="width: 100%; height: 8px; background: #f3f4f6; border-radius: 9999px; overflow: hidden;">
                                <div
                                    style="width: {{ $percentage }}%; height: 100%; background: {{ $info['color'] }}; border-radius: 9999px; transition: width 0.3s ease;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card p-lg">
                <h3 style="margin: 0 0 1rem 0; font-weight: 600;">Quick Actions</h3>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline"
                        style="width: 100%; justify-content: flex-start; gap: 0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        View All Orders
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline"
                        style="width: 100%; justify-content: flex-start; gap: 0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Manage Users
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-outline"
                        style="width: 100%; justify-content: flex-start; gap: 0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add New Service
                    </a>
                    <a href="{{ route('admin.portfolio.create') }}" class="btn btn-outline"
                        style="width: 100%; justify-content: flex-start; gap: 0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        Add Portfolio Item
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection