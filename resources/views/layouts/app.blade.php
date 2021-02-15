<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Docs') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.0.2/dist/base.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.0.2/dist/components.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@tailwindcss/typography@0.1.2/dist/typography.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.0.2/dist/utilities.min.css">
    <link rel="stylesheet" href="//unpkg.com/@highlightjs/cdn-assets@10.5.0/styles/default.min.css">
    <script src="//unpkg.com/@highlightjs/cdn-assets@10.5.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</head>

<body id="top" class="antialiased">
    @yield('content')
</body>

</html>