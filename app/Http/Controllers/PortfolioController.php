<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Service;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::with('service');

        if ($request->has('service')) {
            $service = Service::where('slug', $request->service)->first();
            if ($service) {
                $query->where('service_id', $service->id);
            }
        }

        $portfolios = $query->paginate(9);
        $services = Service::all(); // For filter dropdown

        return view('pages.portfolio', compact('portfolios', 'services'));
    }

    public function show($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();
        return view('pages.portfolio-single', compact('portfolio'));
    }
}
