<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\Service;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        $serviceIds = Service::pluck('id')->toArray();
        if (empty($serviceIds))
            return;

        $portfolios = [
            [
                'title' => 'Neon Light Rebranding',
                'slug' => 'neon-light-rebranding',
                'client_name' => 'Neon Energy Co.',
                'description' => 'Energizing a startup brand with a fresh, electric visual identity.',
                'tags' => ['Branding', 'Design'],
                'cover_image' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?q=80&w=1000&auto=format&fit=crop',
                'images' => ['https://images.unsplash.com/photo-1563245372-f21724e3856d?q=80&w=1000&auto=format&fit=crop'],
                'service_id' => $serviceIds[array_rand($serviceIds)],
            ],
            [
                'title' => 'TechStart Social Strategy',
                'slug' => 'techstart-social',
                'client_name' => 'TechStart',
                'description' => 'Growing a tech community from 0 to 10k.',
                'tags' => ['Social Media', 'Community'],
                'cover_image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1000&auto=format&fit=crop',
                'images' => [],
                'service_id' => $serviceIds[array_rand($serviceIds)],
            ],
            [
                'title' => 'EcoLife E-commerce',
                'slug' => 'ecolife-ecommerce',
                'client_name' => 'EcoLife',
                'description' => 'Sustainable product store design and development.',
                'tags' => ['Web Dev', 'E-commerce'],
                'cover_image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1000&auto=format&fit=crop',
                'images' => [],
                'service_id' => $serviceIds[array_rand($serviceIds)],
            ],
        ];

        foreach ($portfolios as $data) {
            // Use remote images for seeding if no local files
            if (!$data['cover_image']) {
                // Unsplash random
                $data['cover_image'] = null; // Or logic to download/save
            }
            // For now, minimal seeding
            // $data['images'] = json_encode($data['images']); // REMOVED: Model handles casting
            // $data['tags'] = json_encode($data['tags']);     // REMOVED: Model handles casting
            Portfolio::create($data);
        }
    }
}
