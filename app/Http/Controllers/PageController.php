<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Contact;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::where('featured', true)->take(3)->get();
        $portfolios = Portfolio::latest()->take(4)->get();
        $testimonials = Testimonial::where('published', true)->take(3)->get();

        return view('pages.home', compact('services', 'portfolios', 'testimonials'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create($validated);

        return redirect()->route('contact')->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('published', true)->get();
        return view('pages.testimonials', compact('testimonials'));
    }
}
