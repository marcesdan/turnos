<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="app sidebar-mini rtl">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <main class="app-content">
            @yield('content')
            @include('layouts.footer')
        </main>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{ mix('/js/vendor.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
        @includeWhen(session('status'), 'layouts.notify')
        @yield('scripts')
      </body>
</html>
