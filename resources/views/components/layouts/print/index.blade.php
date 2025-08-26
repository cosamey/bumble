<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.layouts.print.meta')

        @vite(['resources/css/print.css'])

        @stack('head')
    </head>

    <body>
        {{ $slot }}

        @stack('footer')
    </body>
</html>
