<!DOCTYPE html>
<html lang="{{ auth()->check() ? auth()->user()->language : config('app.locale') }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="icon" type="image/png" href="/favicon.png">
        <link id="theme-color" rel="stylesheet" href="/themes/{{ config('enraiged.theme.color') }}/theme.css">
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="antialiased">
        @inertia
    </body>
</html>
