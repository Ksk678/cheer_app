<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huntsman</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="#">Huntsman</a>
            </div>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <!-- Page Heading -->
        @isset($header2)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header2 }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>

        </main>
    </header>

</body>

</html>
