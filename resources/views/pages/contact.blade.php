@extends('layouts.app')

@section('title', 'Contact Us | Bizu Agency')

@section('content')
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">Let's Connect</h1>
            <p class="text-light" style="max-width: 600px; margin: 0 auto;">Have a project in mind? We'd love to hear
                from you.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container grid grid-2">
            <!-- Contact Info -->
            <div>
                <h2 class="mb-md">Get in Touch</h2>
                <div class="mb-lg">
                    <h3 style="font-size: 1.25rem;">📍 Visit Us</h3>
                    <p class="text-light">123 Creative Ave, Design District<br>New York, NY 10012</p>
                </div>
                <div class="mb-lg">
                    <h3 style="font-size: 1.25rem;">📧 Email Us</h3>
                    <p class="text-light"><a href="mailto:hello@bizu.agency">hello@bizu.agency</a></p>
                </div>
                <div class="mb-lg">
                    <h3 style="font-size: 1.25rem;">📞 Call Us</h3>
                    <p class="text-light">+1 (555) 123-4567</p>
                </div>
            </div>

            <!-- Form -->
            <div class="card">
                @if(session('success'))
                    <div
                        style="padding: 1rem; background: #d1fae5; border: 1px solid #6ee7b7; border-radius: 0.5rem; margin-bottom: 1.5rem; color: #065f46;">
                        <strong>✓ Success!</strong> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div
                        style="padding: 1rem; background: #fee2e2; border: 1px solid #fca5a5; border-radius: 0.5rem; margin-bottom: 1.5rem; color: #991b1b;">
                        <strong>⚠ Error!</strong> Please fix the following issues:
                        <ul style="margin: 0.5rem 0 0 1.5rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-input" required placeholder="John Doe"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" required placeholder="john@example.com"
                            value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <select name="subject" class="form-select" required>
                            <option value="">Select a topic...</option>
                            <option value="New Project" {{ old('subject') == 'New Project' ? 'selected' : '' }}>New Project
                            </option>
                            <option value="Careers" {{ old('subject') == 'Careers' ? 'selected' : '' }}>Careers</option>
                            <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-textarea" rows="5" required
                            placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection