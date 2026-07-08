<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ZANEXT STORE — Step Beyond Limits')</title>
    <meta name="description" content="@yield('description', 'A futuristic marketplace for sneakers and streetwear. Premium drops, limited collaborations, and the boldest collections of 2026.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen flex flex-col">
        @include('partials.navbar')
        <main class="flex-1 pt-24">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
</body>
</html>
