<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
            rel="stylesheet"
        />

        <!-- core:css -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}" />
        <!-- endinject -->

        <!-- inject:css -->
        <link
            rel="stylesheet"
            href="../../../assets/fonts/sansation/css/sansationfont.css"
        />
        <link
            rel="stylesheet"
            href="../../../assets/fonts/dyadis/css/dyadisfont.css"
        />
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}" />
        <!-- End plugin css for this page -->

        
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}" />
        <!-- End layout styles -->

        <!-- Styles -->
        @yield("styles")
        @vite("resources/css/app.css")
    </head>
    <body>
        @yield('content')

        <script src="{{ asset('/assets/vendors/iconify/iconify-icon.min.js') }}"></script>

        <!-- core:js -->
        <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
        <!-- endinject -->

        <!-- Plugin js for this page -->
        <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <!-- End plugin js for this page -->

        @yield('scripts')
    </body>
</html>