<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fav/fav.png') }}">

    <title>{{ config('app.name', 'SHOPLITE') }}</title>
     <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('shop.style')

</head>

<body class="antialiased">
    <!-- Main Layout -->
      <div class="flex h-screen bg-gray-50">

        @include('shop.sidebar')


            {{ $slot }}

    </div>

    @include('shop.script')
</body>

</html>
