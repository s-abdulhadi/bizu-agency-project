<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category', 'all');

        if (strlen($query) < 2) {
            return response()->json(['results' => [], 'count' => 0, 'query' => $query]);
        }

        // Cache results for 5 minutes
        $cacheKey = "search_{$query}_{$category}";

        $results = Cache::remember($cacheKey, 300, function () use ($query, $category) {
            $results = [];

            // Search Services
            if ($category === 'all' || $category === 'services') {
                $services = Service::where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('short_description', 'like', "%{$query}%");
                })
                    ->limit(10)
                    ->get(['id', 'title', 'slug', 'icon', 'price']);

                foreach ($services as $service) {
                    // Handle image URL
                    $imageUrl = null;
                    if ($service->icon) {
                        // Check if it's an external URL
                        if (str_starts_with($service->icon, 'http://') || str_starts_with($service->icon, 'https://')) {
                            $imageUrl = $service->icon;
                        } else {
                            $imageUrl = asset('storage/' . $service->icon);
                        }
                    }

                    $results[] = [
                        'type' => 'Service',
                        'category' => 'Services',
                        'title' => $service->title,
                        'subtitle' => $service->price ? 'Starting at $' . number_format($service->price, 2) : null,
                        'url' => route('services.show', $service->slug),
                        'image' => $imageUrl,
                    ];
                }
            }

            // Search Portfolio
            if ($category === 'all' || $category === 'portfolio') {
                $portfolios = Portfolio::where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhere('client_name', 'like', "%{$query}%");
                })
                    ->limit(10)
                    ->get(['id', 'title', 'slug', 'cover_image', 'client_name']);

                foreach ($portfolios as $item) {
                    // Handle image URL
                    $imageUrl = null;
                    if ($item->cover_image) {
                        if (str_starts_with($item->cover_image, 'http://') || str_starts_with($item->cover_image, 'https://')) {
                            $imageUrl = $item->cover_image;
                        } else {
                            $imageUrl = asset('storage/' . $item->cover_image);
                        }
                    }

                    $results[] = [
                        'type' => 'Portfolio',
                        'category' => 'Portfolio',
                        'title' => $item->title,
                        'subtitle' => $item->client_name ? 'Client: ' . $item->client_name : null,
                        'url' => route('portfolio.show', $item->slug),
                        'image' => $imageUrl,
                    ];
                }
            }

            // Search Products
            if ($category === 'all' || $category === 'products') {
                $products = Product::where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('short_description', 'like', "%{$query}%");
                })
                    ->limit(10)
                    ->get(['id', 'name', 'slug', 'price', 'images']);

                foreach ($products as $product) {
                    // Handle image URL
                    $imageUrl = null;
                    if ($product->images) {
                        $images = json_decode($product->images);
                        if ($images && is_array($images) && count($images) > 0) {
                            $firstImage = $images[0];
                            if (str_starts_with($firstImage, 'http://') || str_starts_with($firstImage, 'https://')) {
                                $imageUrl = $firstImage;
                            } else {
                                $imageUrl = asset('storage/' . $firstImage);
                            }
                        }
                    }

                    $results[] = [
                        'type' => 'Product',
                        'category' => 'Products',
                        'title' => $product->name,
                        'subtitle' => null,
                        'url' => route('products.show', $product->slug),
                        'image' => $imageUrl,
                        'price' => '$' . number_format($product->price, 2),
                    ];
                }
            }

            return $results;
        });

        return response()->json([
            'results' => $results,
            'count' => count($results),
            'query' => $query,
            'category' => $category
        ]);
    }
}
