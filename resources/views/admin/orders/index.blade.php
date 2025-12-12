@extends('layouts.admin')

@section('title', 'Orders | Admin Panel')
@section('header', 'Order Management')

@section('content')
    <div class="mb-lg">
        <h2 class="mb-xs" style="font-size: 1.5rem; font-weight: 700;">Orders</h2>
        <p class="text-light">View and manage all customer orders and transactions.</p>
    </div>

    @if(session('success'))
        <div class="mb-lg p-md"
            style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border-radius: 0.75rem; border-left: 4px solid #10b981; display: flex; align-items: center; gap: 0.75rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-4 gap-md mb-lg"
        style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div class="card p-md"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Total Orders</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $orders->total() }}</h3>
                </div>
                <div
                    style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-md"
            style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Pending</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">
                        {{ $orders->where('status', 'pending')->count() }}</h3>
                </div>
                <div
                    style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-md"
            style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Processing</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">
                        {{ $orders->where('status', 'processing')->count() }}</h3>
                </div>
                <div
                    style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-md"
            style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Completed</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">
                        {{ $orders->where('status', 'completed')->count() }}</h3>
                </div>
                <div
                    style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-0"
        style="overflow: hidden; border-radius: 0.75rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);">
        <div
            style="padding: 1.25rem; border-bottom: 1px solid var(--color-border); background: linear-gradient(to right, #f9fafb, #ffffff);">
            <h3 style="margin: 0; font-weight: 600; font-size: 1.125rem;">All Orders</h3>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; text-align: left; border-bottom: 2px solid var(--color-border);">
                        <th
                            style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                            ID</th>
                        <th
                            style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                            Customer</th>
                        <th
                            style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                            Date</th>
                        <th
                            style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                            Total</th>
                        <th
                            style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                            Status</th>
                        <th
                            style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr style="border-bottom: 1px solid var(--color-border); transition: background-color 0.2s;"
                            onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 1rem; font-weight: 600; color: var(--color-primary);">#{{ $order->id }}</td>
                            <td style="padding: 1rem;">
                                <div style="font-weight: 600;">{{ $order->customer_name }}</div>
                                <div style="font-size: 0.75rem; color: var(--color-text-light); margin-top: 0.125rem;">
                                    {{ $order->customer_email }}</div>
                            </td>
                            <td style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem;">
                                {{ $order->created_at->format('M d, Y') }}</td>
                            <td style="padding: 1rem; font-weight: 700; font-size: 1rem;">
                                ${{ number_format($order->total_amount, 2) }}</td>
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
                                    style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: capitalize;">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline"
                                    style="padding: 0.375rem 0.875rem; border-color: var(--color-primary); color: var(--color-primary); font-size: 0.875rem; font-weight: 600;">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 4rem; text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" style="color: var(--color-text-light);">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-weight: 600; color: var(--color-text);">No orders found</p>
                                        <p style="margin: 0.25rem 0 0 0; color: var(--color-text-light); font-size: 0.875rem;">
                                            Orders will appear here when customers make purchases</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($orders->hasPages())
        <div class="mt-lg">
            {{ $orders->links() }}
        </div>
    @endif
@endsection