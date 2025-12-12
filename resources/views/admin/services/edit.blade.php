@extends('layouts.admin')

@section('title', 'Edit Service | Admin Panel')
@section('header', 'Edit Service')

@section('content')
    <div class="mb-lg">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Services
        </a>
    </div>

    <div class="card p-xl" style="max-width: 800px;">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-lg">
                <label for="title" class="block mb-sm font-bold">Service Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $service->title }}"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;"
                    required>
            </div>

            <div class="mb-lg">
                <label for="icon" class="block mb-sm font-bold">Icon (Image/SVG)</label>

                @if($service->icon)
                    <div class="mb-sm">
                        <p class="text-sm text-light mb-xs">Current Icon:</p>
                        @if(Str::startsWith($service->icon, 'http'))
                            <img src="{{ $service->icon }}" alt="Current Icon"
                                style="width: 60px; height: 60px; object-fit: contain; border-radius: 8px; border: 2px solid var(--color-border); padding: 4px;">
                        @else
                            <img src="{{ asset('storage/' . $service->icon) }}" alt="Current Icon"
                                style="width: 60px; height: 60px; object-fit: contain; border-radius: 8px; border: 2px solid var(--color-border); padding: 4px;">
                        @endif
                    </div>
                @endif

                <input type="file" name="icon" id="icon" class="form-control" data-preview="icon-preview"
                    accept="image/jpeg,image/jpg,image/png,image/gif,image/svg+xml,image/webp"
                    style="width: 100%; padding: 0.5rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                <p class="text-sm text-light mt-xs">Upload a new icon to replace the current one (Max 5MB,
                    JPEG/PNG/GIF/SVG/WebP)</p>

                <!-- Preview Container -->
                <div id="icon-preview" class="mt-md"></div>
            </div>

            <div class="mb-lg">
                <label for="short_description" class="block mb-sm font-bold">Short Description</label>
                <textarea name="short_description" id="short_description" rows="3" class="form-control"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;"
                    required>{{ $service->short_description }}</textarea>
            </div>

            <div class="mb-lg">
                <label for="long_description" class="block mb-sm font-bold">Full Description (Optional)</label>
                <textarea name="long_description" id="long_description" rows="6" class="form-control"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">{{ $service->long_description }}</textarea>
            </div>

            <div class="grid grid-2 gap-md mb-lg">
                <div>
                    <label for="price" class="block mb-sm font-bold">Starting Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control"
                        value="{{ $service->price }}"
                        style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                </div>
                <div>
                    <label for="featured" class="block mb-sm font-bold">Featured?</label>
                    <select name="featured" id="featured"
                        style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                        <option value="0" {{ $service->featured == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $service->featured == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">Update Service</button>
            </div>
        </form>
    </div>
@endsection