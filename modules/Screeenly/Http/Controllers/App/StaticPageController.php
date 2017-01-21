<?php

namespace Screeenly\Http\Controllers\App;

use App\Http\Controllers\Controller;

class StaticPageController extends Controller
{
    public function imprint()
    {
        return view('screeenly::static.imprint');
    }

    public function terms()
    {
        return view('screeenly::static.terms');
    }

    public function about()
    {
        return view('screeenly::static.about');
    }
}
