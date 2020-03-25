<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Filetinmel</title>
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('styles')
    </head>
    <body>
        @yield('body')

        @stack('scripts')
    </body>
</html>
