<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bizu Agency | Creative Social Media Marketing')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @stack('styles')
</head>

<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Sliding Cart -->
    <div id="cart-sidebar" class="cart-sidebar">
        <div class="cart-sidebar-header">
            <h3>Your Cart</h3>
            <button id="close-cart-sidebar" class="btn-close">&times;</button>
        </div>
        <div id="cart-sidebar-body" class="cart-sidebar-body">
            @include('partials.cart-sidebar-content')
        </div>
    </div>
    <div id="cart-overlay" class="cart-overlay"></div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/cart-ajax.js') }}"></script>
    @stack('scripts')
</body>

</html>