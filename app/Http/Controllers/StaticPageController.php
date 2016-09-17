<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class StaticPageController extends Controller
{
    public function imprint()
    {
        return view('static.imprint');
    }

    public function terms()
    {
        return view('static.terms');
    }

    public function privacy()
    {
        return view('static.privacy');
    }

    public function about()
    {
        return view('static.about');
    }
}
