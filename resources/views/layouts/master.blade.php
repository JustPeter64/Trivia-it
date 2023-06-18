<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Trivia it!">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trivia it!</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::to('favicon.jpg') }}" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

</head>

<body>

    @include('partials.header')

    @yield('content')

</body>

</html>
