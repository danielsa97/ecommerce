<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title', session()->get('ecommerce')->name ?? env('APP_NAME'))</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if(session('favicon'))
        <link rel="shortcut icon" href="{{ route('image.index', session('favicon'))}}"/>
    @endif

</head>
<body>
@yield('body')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
@yield('adminlte_js')
</body>
</html>
