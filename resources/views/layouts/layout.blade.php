<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="robots" content="noindex">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <title>@section('title')@show</title>

    @vite(['resources/scss/app.scss'])
</head>
<body  class="{{ Route::is('front.policy') ? '_policy' : '_main' }}">

    <div class="wrapper">
        @if(!Route::is('front.policy'))
            @include('common.header')
        @endif

        @yield('content')

        @if(!Route::is('front.policy'))
            @include('common.footer')
        @endif

    </div>

    @vite(['resources/js/app.js'])
</body>
</html>
