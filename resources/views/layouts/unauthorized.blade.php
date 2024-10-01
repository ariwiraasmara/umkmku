{{--! Copyright @ Syahri Ramadhan Wiraasmara--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="keywords" content="UMKMKU" />
        <meta content="IE=edge" http-equiv="x-ua-compatible">
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, user-scalable=no" >
        <meta name="apple-mobile-web-app-capable" content="yes" >
        <meta name="apple-touch-fullscreen" content="yes" >

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased min-h-screen">
        <div class="">
            <div class="">
                @yield('content')
            </div>
              
            
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </div>
    </body>

    <footer>

    </footer>
</html>