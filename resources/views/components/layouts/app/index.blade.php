<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        @include('components.layouts.app.scripts')

        @head

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        @stack('head')
    </head>

    <body>
        {{ $slot }}

        @livewireScriptConfig
        @fluxScripts

        @stack('footer')
    </body>
</html>
