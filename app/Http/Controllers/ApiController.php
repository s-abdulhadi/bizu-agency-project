<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Portfolio;

class ApiController extends Controller
{
    public function services()
    {
        return response()->json(Service::all());
    }

    public function portfolios()
    {
        return response()->json(Portfolio::with('service')->get());
    }
}
