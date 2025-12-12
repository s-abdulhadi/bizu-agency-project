@extends('layouts.admin')

@section('title', 'Users | Admin Panel')
@section('header', 'User Management')

@section('content')
    <div class="mb-lg">
        <h2 class="mb-xs" style="font-size: 1.5rem; font-weight: 700;">Users</h2>
        <p class="text-light">Manage registered users and customer accounts.</p>
    </div>

    @if(session('success'))
        <div class="mb-lg p-md" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border-radius: 0.75rem; border-left: 4px solid #10b981; display: flex; align-items: center; gap: 0.75rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-lg p-md" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; border-radius: 0.75rem; border-left: 4px solid #ef4444; display: flex; align-items: center; gap: 0.75rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <span style="font-weight: 500;">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-3 gap-md mb-lg" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div class="card p-md" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Total Users</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $users->total() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </div>
        </div>

        <div class="card p-md" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Admins</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $users->where('is_admin', 1)->count() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                </div>
            </div>
        </div>

        <div class="card p-md" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="margin: 0; opacity: 0.9; font-size: 0.875rem;">Customers</p>
                    <h3 style="margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 700;">{{ $users->where('is_admin', 0)->count() }}</h3>
                </div>
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-0" style="overflow: hidden; border-radius: 0.75rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);">
        <div style="padding: 1.25rem; border-bottom: 1px solid var(--color-border); background: linear-gradient(to right, #f9fafb, #ffffff);">
            <h3 style="margin: 0; font-weight: 600; font-size: 1.125rem;">All Users</h3>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; text-align: left; border-bottom: 2px solid var(--color-border);">
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">ID</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Name</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Email</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Role</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Registered</th>
                        <th style="padding: 1rem; color: var(--color-text-light); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom: 1px solid var(--color-border); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 1rem; font-weight: 600; color: var(--color-primary);">#{{ $user->id }}</td>
                            <td style="padding: 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4f46e5; font-weight: 700; font-size: 1rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span style="font-weight: 600;">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td style="padding: 1rem; color: var(--color-text-light);">{{ $user->email }}</td>
                            <td style="padding: 1rem;">
                                @if($user->is_admin)
                                    <span style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); color: #4338ca; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700;">ADMIN</span>
                                @else
                                    <span style="background: #f3f4f6; color: #6b7280; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">USER</span>
                                @endif
                            </td>
                            <td style="padding: 1rem; color: var(--color-text-light); font-size: 0.875rem;">{{ $user->created_at->format('M d, Y') }}</td>
                            <td style="padding: 1rem;">
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display: inline;">
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
                                @else
                                    <span style="color: var(--color-text-light); font-size: 0.875rem; font-style: italic;">Current User</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 4rem; text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                                    <div style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-text-light);"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-weight: 600; color: var(--color-text);">No users found</p>
                                        <p style="margin: 0.25rem 0 0 0; color: var(--color-text-light); font-size: 0.875rem;">Users will appear here when they register</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($users->hasPages())
        <div class="mt-lg">
            {{ $users->links() }}
        </div>
    @endif
@endsection
