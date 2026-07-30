<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        @fonts

        @vite(['resources/css/print.css'])

        @stack('head')
    </head>

    <body>
        {{ $slot }}

        @stack('footer')
    </body>
</html>
