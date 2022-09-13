<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ __('Ankiety') }}" >
    <meta name="author" content="Gabriel Lichacz">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Webpage Title -->
    <title> {{ __('Ankiety') }} </title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/de40dc4b28.js" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <!-- <script src="{{ asset('js/swiper.min.js') }}" defer></script> -->
    <script src="{{ asset('js/purecounter.min.js') }}" defer></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}" defer></script>
    <!-- <script src="{{ asset('js/scripts.js') }}" defer></script> -->

	<!-- Favicon  -->
    <link rel="icon" href="/images/favicon.png">
</head>
<body>
    <div id="app" class="bg-white">

        <!-- Navigation menu -->
        @include('layouts.components.navigation')

        <!-- Masthead-->
        @include('layouts.components.masthead')
        <!-- end of Masthead -->

        <!-- Main -->
        <main class="py-4">
            @yield('content')
        </main>
        <!-- end of Main -->

        <!-- Footer menu -->
        @include('layouts.components.footer')

    </div>
</body>
</html>