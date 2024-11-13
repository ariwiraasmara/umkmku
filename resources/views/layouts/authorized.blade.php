{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
@if( isset($uniquekey) )
@php session_start(); @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>{{ $pagetitle }}</title>
        <meta name="description" content="{{ $description }}">
        <meta name="keywords" content="{{ $keywords }}" />
        <meta name="uniquekey" content="{{ $uniquekey }}" />
        <meta name="author" content="Syahri Ramadhan Wiraasmara (ARI)">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta content="IE=edge" http-equiv="x-ua-compatible">
        <meta name="apple-mobile-web-app-capable" content="yes" >
        <meta name="apple-touch-fullscreen" content="yes" >
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, user-scalable=no" >
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
        .copyright, #copyright {
            visibility: hidden;
        }
        </style>
    </head>

    <body class="font-sans antialiased min-h-full">
        <div class="static">
            {{-- @yield('content') --}}
            {{ $slot }}
        </div>
    
        @livewireScriptConfig 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>

    <footer>
        <div id="copyright" class="copyright text-center font-bold">
            {{ $copyright }}
        </div>
    </footer>
</html>
@else
<html>
    <head>
        <style>
            body {
                background: black;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <img src="https://images.pexels.com/photos/1089438/pexels-photo-1089438.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" />
    </body>
</html>
@endif