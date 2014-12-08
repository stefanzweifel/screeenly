<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">

        @if (trim($__env->yieldContent('meta_title')))
            <title>@yield('meta_title') | screeenly</title>
        @else
            <title>screeenly | dead simple screenshot API</title>
        @endif

        <meta name="description" content="@yield('meta_description', 'Meta Text')" />

        {{-- Basic Stylesheets --}}
        <link rel="stylesheet" href="{{ URL::asset('assets/styles/vendor.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/styles/main.min.css') }}">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>


        @yield('styles')

        {{-- Apple Touch Icons --}}
        <link rel="apple-touch-icon" href="{{ URL::asset('assets/images/apple-touch-icon-57x57.png') }}" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets/images/apple-touch-icon-76x76.png') }}" />
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('assets/images/apple-touch-icon-120x120.png') }}" />
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('assets/images/apple-touch-icon-152x152.png') }}" />

        <link rel="shortcut icon" href="{{ URL::asset('/favicon.ico?v1') }}">

    </head>
    <body>
