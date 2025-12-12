<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'featured' => 'nullable|boolean',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->has('featured') ? (bool) $request->featured : false;

        // Handle Icon Upload if present
        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'featured' => 'nullable|boolean',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->has('featured') ? (bool) $request->featured : false;

        // Handle Icon Upload if present
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        // Delete icon if exists
        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
