<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() == 'ar') dir="rtl"@endif>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=5, user-scalable=yes, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ settings()->favicon_image }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ static_asset('frontend/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ static_asset('frontend/css/odometer.css') }}"/>
    <link rel="stylesheet" href="{{ static_asset('frontend/css/swiper-bundle.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="{{ static_asset('backend/plugins') }}/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ static_asset('frontend/theme-5/css/theme-5.css') }}"/>
    <link rel="stylesheet" href="{{ static_asset('backend/css/modern-ui.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --t5-primary: {{ settings()->primary_color ?? '#0ea5e9' }};
            --t5-primary-dark: {{ settings()->primary_color ?? '#0284c7' }};
            --t5-primary-light: color-mix(in srgb, {{ settings()->primary_color ?? '#0ea5e9' }} 15%, white);
            --t5-accent: color-mix(in srgb, {{ settings()->primary_color ?? '#0ea5e9' }} 70%, #6366f1);
        }
    </style>
</head>
<body class="t5-body">
    @include(active_theme() . '.layouts.navbar')
    <main>@yield('content')</main>
    @include(active_theme() . '.layouts.footer')

    <script src="{{ static_asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ static_asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ static_asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ static_asset('frontend/js/jquery.odometer.min.js') }}"></script>
    <script src="{{ static_asset('frontend/js/theme.js') }}"></script>
    <script src="{{ static_asset('frontend/theme-5/js/theme-5.js') }}"></script>
    <script src="{{ static_asset('backend/plugins') }}/toastr/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @stack('scripts')
</body>
</html>
