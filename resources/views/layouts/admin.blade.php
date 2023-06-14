<!DOCTYPE html>
<html lang="en-nl">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Trivia it!">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trivia it - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Style -->
        <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">

         <!-- Favicon -->
         <link rel="shortcut icon" href="{{ URL::to('favicon.jpg') }}" type="image/x-icon">

    </head>
    <body>

        @include('partials.header-admin')

        @yield('content')
        
    </body>
</html>
