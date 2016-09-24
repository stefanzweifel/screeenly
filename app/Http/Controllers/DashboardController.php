<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $apiKeys = auth()->user()->apiKeys;

        return view('app.dashboard', compact('apiKeys'));
    }
}
