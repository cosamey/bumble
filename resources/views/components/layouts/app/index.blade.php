<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.layouts.app.meta')

        @include('components.layouts.app.seo')

        @include('components.layouts.app.links')

        @include('components.layouts.app.scripts')

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
