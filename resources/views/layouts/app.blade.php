<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Piloto Tronador">
  <meta name="author" content="webpass.com.ar">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- .ico -->
  <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
  <title>{{ config('app.name', 'Piloto Tronador') }} - @yield('title')</title>

  <!-- CSS - bs - custom -->
  <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <!-- fontawesome iconos -->
  <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

  @include('layouts.partials.header')

  <div class="min-vh-100">
    @yield('content')
  </div>

  @include('layouts.partials.footer')

</body>

</html>
