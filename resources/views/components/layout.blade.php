<!doctype html>
<html lang="en">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>{{ $title ?? 'League Simulator' }}</title>
        @vite('resources/css/app.css')
        @stack('styles')
    </head>
    <body class="bg-slate-800">
        <div class="max-w-7xl mx-auto my-6">
            {{ $slot }}
        </div>
        @stack('scripts')
    </body>
</html>
