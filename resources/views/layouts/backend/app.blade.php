<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('main.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('backend.common.header')
    @include('backend.common.settings')

    <div class="app-main">
        @include('backend.common.sidebar')
        <div class="app-main__outer">
            <div class="app-main__inner">
                @yield('content')
            </div>
            @include('backend.common.footer')
        </div>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('assets/scripts/main.js') }}" defer></script>
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
</body>
</html>
