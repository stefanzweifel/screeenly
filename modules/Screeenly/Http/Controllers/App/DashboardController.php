<?php

namespace Screeenly\Http\Controllers\App;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $apiKeys = auth()->user()->apiKeys;

        return view('app.dashboard', compact('apiKeys'));
    }
}
