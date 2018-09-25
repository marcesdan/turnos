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
        <script src="{{ mix('/js/app.js') }}"></script>
        @includeWhen(session('status'), 'layouts.notify')
        @yield('scripts')
      </body>
</html>
