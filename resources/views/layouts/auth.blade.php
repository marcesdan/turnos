<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.head')

        @yield('styles')

        <title>Turnos</title>
    </head>
    <body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Turnos</h1>
        </div>
        @yield('content')
    </section>
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function () {
            $('.login-box').toggleClass('flipped');
            //return false;
        });    
    </script>

    @yield('scripts')
    
</body>
</html>
