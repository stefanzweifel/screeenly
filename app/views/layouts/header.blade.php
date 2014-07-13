<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">

        @if (trim($__env->yieldContent('meta_title')))
            <title>@yield('meta_title') | screeenly</title>
        @else
            <title>screeenly &bull; dead simple screenshot API</title>
        @endif

        <meta name="description" content="@yield('meta_description', 'Meta Text')" />

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">


        {{-- Basic Stylesheets --}}
        <link rel="stylesheet" href="{{ URL::asset('assets/styles/vendor.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/styles/main.min.css') }}">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>


        @yield('styles')

        {{-- Apple Touch Icons --}}
        <link rel="apple-touch-icon" href="/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />

        <link rel="shortcut icon" href="/favicon.ico?v1.0">

    </head>
    <body>
