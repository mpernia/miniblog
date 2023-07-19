<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta author="Maikel Enrique Pernía Matos" email="contact@maikel-enrique-pernia-matos.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('setting.name', 'MiniBlog') }}</title>
    @yield('head')
    @yield('styles')
</head>
<body>
    @yield('content')
    @yield('scripts')
</body>
</html>
