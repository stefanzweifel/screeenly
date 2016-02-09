<?php

namespace Screeenly\Http\Controllers;

class StaticController extends Controller
{
    /**
     * Diplsay Terms of Service Page.
     *
     * @return Illuminate\View\View
     */
    public function showTerms()
    {
        return view('static.terms');
    }

    /**
     * Display Imprint Page.
     *
     * @return Illuminate\View\View
     */
    public function showImprint()
    {
        return view('static.imprint');
    }

    /**
     * Show Feedback Page.
     *
     * @return Illuminate\View\View
     */
    public function showFeedback()
    {
        return view('static.feedback');
    }

    /**
     * Show FAQ Page.
     *
     * @return Illuminate\View\View
     */
    public function showFaq()
    {
        return view('static.faq');
    }

    public function showDonate()
    {
        return view('static.donate');
    }

    public function privacy()
    {
        return view('static.privacy');
    }
}
