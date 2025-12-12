<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => 'Social Media Management',
                'slug' => 'social-media-management',
                'short_description' => 'Full-service management of your Instagram, TikTok, and LinkedIn profiles.',
                'long_description' => 'We handle everything from strategy to execution. Our team creates engaging content, manages your community, and provides detailed analytics reports.',
                'type' => 'social',
                'price' => 999.00,
                'icon' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?q=80&w=1000&auto=format&fit=crop',
                'featured' => true,
            ],
            [
                'title' => 'Content Creation',
                'slug' => 'content-creation',
                'short_description' => 'Professional photography, videography, and graphic design.',
                'long_description' => 'Visuals that stop the scroll. We produce high-quality photos, videos, and graphics tailored to your brand identity.',
                'type' => 'content',
                'icon' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1000&auto=format&fit=crop',
                'featured' => true,
            ],
            [
                'title' => 'Paid Advertising',
                'slug' => 'paid-advertising',
                'short_description' => 'ROI-focused ad campaigns on Meta and Google.',
                'long_description' => 'Maximize your budget with targeted ad campaigns. We optimize for conversions and provide transparent reporting.',
                'type' => 'ads',
                'icon' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1000&auto=format&fit=crop',
                'featured' => true,
            ],
            [
                'title' => 'SEO Optimization',
                'slug' => 'seo-optimization',
                'short_description' => 'Rank higher on Google and drive organic traffic.',
                'long_description' => 'Improve your visibility with our comprehensive SEO services, including keyword research, on-page optimization, and link building.',
                'type' => 'seo',
                'icon' => 'https://images.unsplash.com/photo-1571786256017-aee7a0c009b6?q=80&w=1000&auto=format&fit=crop',
                'featured' => false,
            ],
            [
                'title' => 'Email Marketing',
                'slug' => 'email-marketing',
                'short_description' => 'Engage your audience with targeted newsletters.',
                'long_description' => 'Build lasting relationships with automated email flows and regular newsletters.',
                'type' => 'email',
                'icon' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?q=80&w=1000&auto=format&fit=crop',
                'featured' => false,
            ],
            [
                'title' => 'Web Development',
                'slug' => 'web-development',
                'short_description' => 'Pixel-perfect websites that convert visitors into customers.',
                'long_description' => 'Custom websites built for performance and conversion. Responsive, fast, and SEO-friendly.',
                'type' => 'web',
                'icon' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?q=80&w=1000&auto=format&fit=crop',
                'featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
