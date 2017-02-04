<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'screeenly')</title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <link rel="apple-touch-icon" href="{{ URL::asset('/images/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('/images/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('/images/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('/images/apple-touch-icon-152x152.png') }}" />

    <link rel="shortcut icon" href="/favicon.ico?v1">

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WWJQP33');</script>
</head>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WWJQP33"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>