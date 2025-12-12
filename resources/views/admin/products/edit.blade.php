@extends('layouts.admin')

@section('title', 'Edit Product | Admin Panel')
@section('header', 'Edit Product')

@section('content')
    <div class="mb-lg">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Products
        </a>
    </div>

    <div class="card p-xl" style="max-width: 800px;">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-lg">
                <label for="name" class="block mb-sm font-bold">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;"
                    required>
            </div>

            <div class="mb-lg">
                <label for="category_id" class="block mb-sm font-bold">Category</label>
                <select name="category_id" id="category_id"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;"
                    required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-lg">
                <label for="images" class="block mb-sm font-bold">Product Images</label>

                @if($product->images && count($product->images) > 0)
                    <div class="mb-sm">
                        <p class="text-sm text-light mb-xs">Current Images:</p>
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            @foreach($product->images as $image)
                                @php
                                    $imgSrc = Str::startsWith($image, 'http') ? $image : asset('storage/' . $image);
                                @endphp
                                <img src="{{ $imgSrc }}" alt="Product Image"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            @endforeach
                        </div>
                    </div>
                @endif

                <input type="file" name="images[]" id="images" class="form-control" multiple
                    accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                    style="width: 100%; padding: 0.5rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                <p class="text-sm text-light mt-xs">Upload new images to replace current ones (Max 5MB each,
                    JPEG/PNG/GIF/WebP). You can select multiple files.</p>
            </div>

            <div class="mb-lg">
                <label for="short_description" class="block mb-sm font-bold">Short Description</label>
                <textarea name="short_description" id="short_description" rows="3" class="form-control"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">{{ $product->short_description }}</textarea>
            </div>

            <div class="mb-lg">
                <label for="full_description" class="block mb-sm font-bold">Full Description</label>
                <textarea name="full_description" id="full_description" rows="6" class="form-control"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">{{ $product->full_description }}</textarea>
            </div>

            <div class="grid grid-2 gap-md mb-lg">
                <div>
                    <label for="price" class="block mb-sm font-bold">Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control"
                        value="{{ $product->price }}"
                        style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;"
                        required>
                </div>
                <div>
                    <label for="stock" class="block mb-sm font-bold">Stock Quantity</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}"
                        style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                </div>
            </div>

            <div class="mb-lg">
                <label for="featured" class="block mb-sm font-bold">Featured Product?</label>
                <select name="featured" id="featured"
                    style="width: 100%; padding: 0.75rem; border: 1px solid var(--color-border); border-radius: 0.375rem;">
                    <option value="0" {{ !$product->featured ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $product->featured ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">Update Product</button>
            </div>
        </form>
    </div>
@endsection