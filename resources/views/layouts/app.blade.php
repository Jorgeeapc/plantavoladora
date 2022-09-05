<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Planta Voladora</title>
        <link rel="shortcut icon" href="icono-titulo.png">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
       
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
       
        @livewireStyles

        <!-- Scripts -->
       
        <script defer src="{{ asset('js/app.js') }}"  ></script>
    
        
    
        
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="max-h-full bg-white-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-purple-300 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
                
            <!-- Page Content -->
            <main>
               {{ $slot }}
            </main>
        </div>

        @stack('modals')

    </body>
</html>
