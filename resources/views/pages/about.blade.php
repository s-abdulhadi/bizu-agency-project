@extends('layouts.app')

@section('title', 'About Us | Bizu Agency')

@section('content')
    <!-- Page Header -->
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">We Are Bizu.</h1>
            <p class="text-light" style="max-width: 600px; margin: 0 auto;">A collective of creatives, strategists, and
                dreamers passionate about building brands that matter.</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="section-padding">
        <div class="container grid grid-2 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Team Working" style="border-radius: var(--radius-lg);">
            </div>
            <div>
                <h2 class="mb-lg">Our Story</h2>
                <p class="text-light mb-md">Founded in 2020, Bizu started with a simple mission: to make social media
                    marketing human again. We believe that behind every metric is a person, and behind every brand is a
                    story waiting to be told.</p>
                <p class="text-light mb-lg">We've grown from a small duo to a full-service agency, helping clients
                    across the globe connect with their audiences in meaningful ways.</p>
                <div class="flex gap-md">
                    <div>
                        <h3 class="text-primary mb-0">50+</h3>
                        <span class="text-light text-sm">Clients Served</span>
                    </div>
                    <div>
                        <h3 class="text-primary mb-0">120+</h3>
                        <span class="text-light text-sm">Projects Completed</span>
                    </div>
                    <div>
                        <h3 class="text-primary mb-0">5y</h3>
                        <span class="text-light text-sm">Experience</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section-padding" style="background-color: white;">
        <div class="container">
            <h2 class="text-center mb-lg">Meet The Team</h2>
            <div class="grid grid-4">
                <!-- Member 1 -->
                <div class="card text-center">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="CEO"
                        style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem;">
                    <h3>Sarah J.</h3>
                    <p class="text-light text-sm">Founder & CEO</p>
                </div>
                <!-- Member 2 -->
                <div class="card text-center">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Creative Director"
                        style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem;">
                    <h3>Mike T.</h3>
                    <p class="text-light text-sm">Creative Director</p>
                </div>
                <!-- Member 3 -->
                <div class="card text-center">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Strategist"
                        style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem;">
                    <h3>Elena R.</h3>
                    <p class="text-light text-sm">Lead Strategist</p>
                </div>
                <!-- Member 4 -->
                <div class="card text-center">
                    <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Developer"
                        style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem;">
                    <h3>David K.</h3>
                    <p class="text-light text-sm">Tech Lead</p>
                </div>
            </div>
        </div>
    </section>
@endsection