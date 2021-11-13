<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat App</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/chat.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <script>
        var base_url = '{{ url("/") }}';
    </script>

    <script src="{{ asset('public/js/app.js') }}" async></script>
    <script src="{{ asset('public/js/chat.js') }}"></script>
</head>
<body>
<div id="app">
    @if (auth()->check())

        @if (auth()->user()->can('is_admin'))
            @include('layouts.admin_header')
        @elseif (auth()->user()->can('is_writer'))
            @include('layouts.writer_header')
        @elseif (auth()->user()->can('is_customer'))
            @include('layouts.customer_header')
        @else
            @include('layouts.header_nav')
        @endif
    @else
        @include('layouts.header_nav')
    @endif
    <div class="container-fluid">

        @yield('content')
    </div>

    <div id="chat-overlay" class="row"></div>

    <audio id="chat-alert-sound" style="display: none" muted="muted">
        <source src="{{ asset('public/sound/facebook_chat.mp3') }}" />
    </audio>
</div>

<input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
</body>
</html>
