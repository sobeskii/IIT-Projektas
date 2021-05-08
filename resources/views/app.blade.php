<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="57x57" href='{{ asset("storage/assets/ico/apple-icon-57x57.png") }}'>
        <link rel="apple-touch-icon" sizes="60x60" href='{{ asset("storage/assets/ico/apple-icon-60x60.png") }}'>
        <link rel="apple-touch-icon" sizes="72x72" href='{{ asset("storage/assets/ico/apple-icon-72x72.png") }}'>
        <link rel="apple-touch-icon" sizes="76x76" href='{{ asset("storage/assets/ico/apple-icon-76x76.png") }}'>
        <link rel="apple-touch-icon" sizes="114x114" href='{{ asset("storage/assets/ico/apple-icon-114x114.png") }}'>
        <link rel="apple-touch-icon" sizes="120x120" href='{{ asset("storage/assets/ico/apple-icon-120x120.png") }}'>
        <link rel="apple-touch-icon" sizes="144x144" href='{{ asset("storage/assets/ico/apple-icon-144x144.png") }}'>
        <link rel="apple-touch-icon" sizes="152x152" href='{{ asset("storage/assets/ico/apple-icon-152x152.png") }}'>
        <link rel="apple-touch-icon" sizes="180x180" href='{{ asset("storage/assets/ico/apple-icon-180x180.png") }}'>
        <link rel="icon" type="image/png" sizes="192x192"  href='{{ asset("storage/assets/ico/android-icon-192x192.png") }}'>
        <link rel="icon" type="image/png" sizes="32x32" href='{{ asset("storage/assets/ico/favicon-32x32.png") }}'>
        <link rel="icon" type="image/png" sizes="96x96" href='{{ asset("storage/assets/ico/favicon-96x96.png") }}'>
        <link rel="icon" type="image/png" sizes="16x16" href='{{ asset("storage/assets/ico/favicon-16x16.png") }}'>
        <link rel="manifest" href='{{ asset("storage/assets/ico/manifest.json") }}'>
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content='{{ asset("storage/assets/ico/ms-icon-144x144.png") }}'>
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css">
        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
