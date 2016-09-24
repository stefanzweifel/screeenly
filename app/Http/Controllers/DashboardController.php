<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function index()
    {
        $apiKeys = auth()->user()->apiKeys;

        return view('app.dashboard', compact('apiKeys'));
    }
}
