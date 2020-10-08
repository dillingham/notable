<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('meta')
        <link rel="stylesheet" href="/css/docs.css">
        @stack('head')
    </head>
    <body id="top" class="antialiased">
        @include('layouts.header')
        <div class="flex max-w-screen-lg mx-auto">
            <div class="w-1/5 relative border-r pt-8">
                @include('docs::navigation')
            </div>
            <div>
                @yield('content')
            </div>
            <div class="w-1/5 relative">
                @include('docs::sidebar')
            </div>
            @include('docs::footer')
        </div>
        @stack('foot')
    </body>
</html>


