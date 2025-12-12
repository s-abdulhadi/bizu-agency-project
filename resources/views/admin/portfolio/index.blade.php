@extends('layouts.admin')

@section('title', 'Portfolio | Admin Panel')
@section('header', 'Portfolio Management')

@section('content')
    <div class="mb-lg flex justify-between items-center">
        <div>
            <h2 class="mb-xs" style="font-size: 1.5rem; font-weight: 700;">Portfolio</h2>
            <p class="text-light">Showcase your best work and completed projects.</p>
        </div>
        <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add Portfolio Item
        </a>
    </div>

    @if(session('success'))
        <div class="mb-lg p-md" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border-radius: 0.75rem; border-left: 4px solid #10b981; display: flex; align-items: center; gap: 0.75rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-3 gap-md mb-lg" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div class="card p-md" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Total Projects</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $portfolios->total() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
            </div>
        </div>

        <div class="card p-md" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Active Projects</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $portfolios->count() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
            </div>
        </div>

        <div class="card p-md" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">This Page</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $portfolios->count() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-0" style="overflow: hidden; border-radius: 0.75rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);">
        <div style="padding: 1.25rem; border-bottom: 1px solid var(--color-border); background: linear-gradient(to right, #f9fafb, #ffffff);">
            <h3 style="margin: 0; font-weight: 600; font-size: 1.125rem;">All Portfolio Projects</h3>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; text-align: left; border-bottom: 2px solid var(--color-border);">
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">ID</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Cover</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Title</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Service</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Client</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portfolios as $portfolio)
                        <tr style="border-bottom: 1px solid var(--color-border); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 1rem; font-weight: 600; color: var(--color-primary);">#{{ $portfolio->id }}</td>
                            <td style="padding: 1rem;">
                                @if($portfolio->cover_image)
                                    @php
                                        $coverSrc = Str::startsWith($portfolio->cover_image, 'http') ? $portfolio->cover_image : asset('storage/' . $portfolio->cover_image);
                                    @endphp
                                    <img src="{{ $coverSrc }}" alt="Cover" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                @else
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #4f46e5;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 1rem; font-weight: 600;">{{ $portfolio->title }}</td>
                            <td style="padding: 1rem;">
                                @if($portfolio->service)
                                    <span style="background: #e0e7ff; color: #4f46e5; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                        {{ $portfolio->service->title }}
                                    </span>
                                @else
                                    <span style="color: var(--color-text-light); font-size: 0.875rem;">N/A</span>
                                @endif
                            </td>
                            <td style="padding: 1rem; color: var(--color-text-light);">{{ $portfolio->client_name }}</td>
                            <td style="padding: 1rem;">
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="btn btn-outline" style="padding: 0.375rem 0.75rem; border-color: var(--color-primary); color: var(--color-primary); display: flex; align-items: center; gap: 0.25rem; font-size: 0.875rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.portfolio.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this portfolio item?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline" style="padding: 0.375rem 0.75rem; border-color: #ef4444; color: #ef4444; display: flex; align-items: center; gap: 0.25rem; font-size: 0.875rem;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 4rem; text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                                    <div style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-text-light);"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-weight: 600; color: var(--color-text);">No portfolio items found</p>
                                        <p style="margin: 0.25rem 0 0 0; color: var(--color-text-light); font-size: 0.875rem;">Start showcasing your work by adding a project</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($portfolios->hasPages())
        <div class="mt-lg">
            {{ $portfolios->links() }}
        </div>
    @endif
@endsection