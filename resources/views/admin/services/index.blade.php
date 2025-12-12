@extends('layouts.admin')

@section('title', 'Services | Admin Panel')
@section('header', 'Services Management')

@section('content')
    <div class="mb-lg flex justify-between items-center">
        <div>
            <h2 class="mb-xs" style="font-size: 1.5rem; font-weight: 700;">Services</h2>
            <p class="text-light">Manage your service offerings and packages.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Service
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
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Total Services</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $services->total() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                </div>
            </div>
        </div>

        <div class="card p-md" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Active Services</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $services->count() }}</h3>
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
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $services->count() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-0" style="overflow: hidden; border-radius: 0.75rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);">
        <div style="padding: 1.25rem; border-bottom: 1px solid var(--color-border); background: linear-gradient(to right, #f9fafb, #ffffff);">
            <h3 style="margin: 0; font-weight: 600; font-size: 1.125rem;">All Services</h3>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; text-align: left; border-bottom: 2px solid var(--color-border);">
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">ID</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Icon</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Title</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Description</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Created</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr style="border-bottom: 1px solid var(--color-border); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 1rem; font-weight: 600; color: var(--color-primary);">#{{ $service->id }}</td>
                            <td style="padding: 1rem;">
                                @if($service->icon && Str::startsWith($service->icon, 'http'))
                                    <img src="{{ $service->icon }}" alt="Icon" style="width: 40px; height: 40px; object-fit: contain; border-radius: 8px; border: 2px solid #f3f4f6; padding: 4px;">
                                @elseif($service->icon)
                                    <img src="{{ asset('storage/' . $service->icon) }}" alt="Icon" style="width: 40px; height: 40px; object-fit: contain; border-radius: 8px; border: 2px solid #f3f4f6; padding: 4px;">
                                @else
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #4f46e5; font-weight: 600; font-size: 0.75rem;">N/A</div>
                                @endif
                            </td>
                            <td style="padding: 1rem; font-weight: 600;">{{ $service->title }}</td>
                            <td style="padding: 1rem; max-width: 300px; color: var(--color-text-light);">
                                {{ Str::limit($service->short_description, 60) }}
                            </td>
                            <td style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem;">{{ $service->created_at->format('M d, Y') }}</td>
                            <td style="padding: 1rem;">
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-outline" style="padding: 0.375rem 0.75rem; border-color: var(--color-primary); color: var(--color-primary); display: flex; align-items: center; gap: 0.25rem; font-size: 0.875rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" style="display: inline;">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-text-light);"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-weight: 600; color: var(--color-text);">No services found</p>
                                        <p style="margin: 0.25rem 0 0 0; color: var(--color-text-light); font-size: 0.875rem;">Get started by creating your first service</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($services->hasPages())
        <div class="mt-lg">
            {{ $services->links() }}
        </div>
    @endif
@endsection