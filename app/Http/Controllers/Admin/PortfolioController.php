<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('service')->latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.portfolio.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        // Handle tags (comma separated string -> array)
        if ($request->has('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        Portfolio::create($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $services = Service::all();
        return view('admin.portfolio.edit', compact('portfolio', 'services'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        if ($request->has('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Project deleted successfully.');
    }
}
