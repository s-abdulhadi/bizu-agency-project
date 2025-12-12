<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'client_name' => 'Sarah Jenkins',
                'company' => 'Bloom Boutique',
                'quote' => 'Bizu transformed our social media presence properly. Our engagement has tripled in just two months!',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=150&auto=format&fit=crop',
                'published' => true,
            ],
            [
                'client_name' => 'Mike Ross',
                'company' => 'LegalEagle',
                'quote' => 'Professional, creative, and data-driven. The team at Bizu knows exactly how to target the right audience.',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=150&auto=format&fit=crop',
                'published' => true,
            ],
            [
                'client_name' => 'Elena Rodriguez',
                'company' => 'TechFlow',
                'quote' => 'The best agency we have worked with. Their content creation skills are unmatched.',
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=150&auto=format&fit=crop',
                'published' => true,
            ],
            [
                'client_name' => 'David Kim',
                'company' => 'StartUp Inc',
                'quote' => 'Highly recommended for any business looking to scale their digital marketing efforts.',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=150&auto=format&fit=crop',
                'published' => true,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create($data);
        }
    }
}
