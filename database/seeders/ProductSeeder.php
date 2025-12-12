<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categoryIds = Category::pluck('id')->toArray();
        if (empty($categoryIds))
            return;

        $products = [
            [
                'name' => 'Minimalist Instagram Bundle',
                'slug' => 'minimalist-instagram-bundle',
                'short_description' => '50+ fully editable Canva templates.',
                'full_description' => 'Take the stress out of content creation with our bundle of 50+ fully editable Canva templates. Designed for influencers, coaches, and small business owners who want a cohesive, professional aesthetic.',
                'price' => 29.00,
                'stock' => 100,
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'featured' => true,
                'images' => ['https://images.unsplash.com/photo-1611162617474-5b21e879e113?q=80&w=1000&auto=format&fit=crop'],
            ],
            [
                'name' => 'Lightroom Presets: Moody',
                'slug' => 'lightroom-presets-moody',
                'short_description' => '10 Presets for Desktop & Mobile.',
                'full_description' => 'Give your photos a moody, cinematic look with one click.',
                'price' => 19.00,
                'stock' => 999,
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'featured' => false,
                'images' => ['https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1000&auto=format&fit=crop'],
            ],
            [
                'name' => 'Social Media Strategy Guide',
                'slug' => 'social-strategy-guide',
                'short_description' => 'The ultimate guide to growing your brand online.',
                'full_description' => 'A comprehensive 50-page PDF guide covering everything from content pillars to analytics.',
                'price' => 39.00,
                'stock' => 999,
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'featured' => true,
                'images' => ['https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=1000&auto=format&fit=crop'],
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
