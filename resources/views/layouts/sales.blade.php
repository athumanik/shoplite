<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fav/fav.png') }}">

    <title>{{ config('app.name', 'SHOPLITE') }}</title>

    @include('sales.style')

</head>

<body class="antialiased">
    <!-- Main Layout -->
      <div class="flex h-screen bg-gray-50">

        @include('sales.sidebar')


            {{ $slot }}

    </div>

    @include('sales.script')
</body>

</html>
