<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.head')
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body class="app sidebar-mini rtl">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <main class="app-content">
            @yield('content')
            @include('layouts.footer')
        </main>
        @includeWhen(session('status'), 'layouts.notify')
        @yield('scripts')
      </body>
</html>
