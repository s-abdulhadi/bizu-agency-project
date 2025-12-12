@extends('layouts.admin')

@section('title', 'Edit Portfolio Item | Admin Panel')
@section('header', 'Edit Portfolio Item')

@section('content')
    <div class="mb-lg">
        <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Portfolio
        </a>
    </div>

    <div class="card p-xl" style="max-width: 800px;">
        <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-lg">
                <label for="title" class="block mb-sm font-bold">Project Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $portfolio->title }}"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;"
                    required>
            </div>

            <div class="mb-lg">
                <label for="service_id" class="block mb-sm font-bold">Related Service</label>
                <select name="service_id" id="service_id"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                    <option value="">-- Select Service --</option>
                    @foreach(\App\Models\Service::all() as $service)
                        <option value="{{ $service->id }}" {{ $portfolio->service_id == $service->id ? 'selected' : '' }}>
                            {{ $service->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-lg">
                <label for="client_name" class="block mb-sm font-bold">Client Name</label>
                <input type="text" name="client_name" id="client_name" class="form-control"
                    value="{{ $portfolio->client_name }}"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
            </div>

            <div class="mb-lg">
                <label for="cover_image" class="block mb-sm font-bold">Cover Image</label>

                @if($portfolio->cover_image)
                    <div class="mb-sm">
                        <p class="text-sm text-light mb-xs">Current Cover Image:</p>
                        @php
                            $coverSrc = Str::startsWith($portfolio->cover_image, 'http') ? $portfolio->cover_image : asset('storage/' . $portfolio->cover_image);
                        @endphp
                        <img src="{{ $coverSrc }}" alt="Current Cover"
                            style="max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    </div>
                @endif

                <input type="file" name="cover_image" id="cover_image" class="form-control" data-preview="cover-preview"
                    accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                    style="width: 100%; padding: 0.5rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                <p class="text-sm text-light mt-xs">Upload a new cover image to replace the current one (Max 5MB,
                    JPEG/PNG/GIF/WebP)</p>

                <!-- Preview Container -->
                <div id="cover-preview" class="mt-md"></div>
            </div>

            <div class="mb-lg">
                <label for="description" class="block mb-sm font-bold">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">{{ $portfolio->description }}</textarea>
            </div>

            <div class="mb-lg">
                <label for="tags" class="block mb-sm font-bold">Tags (comma-separated)</label>
                <input type="text" name="tags" id="tags" class="form-control"
                    value="{{ is_array($portfolio->tags) ? implode(', ', $portfolio->tags) : $portfolio->tags }}"
                    placeholder="e.g. Design, Branding, Web"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">Update Portfolio
                    Item</button>
            </div>
        </form>
    </div>
@endsection