<!DOCTYPE html>
<html lang="en" @if(app()->getLocale() == 'ar') dir="rtl"@endif>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,  minimum-scale=1, maximum-scale =1, user-scalable = no , shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ settings()->favicon_image }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ static_asset('frontend/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ static_asset('frontend/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ static_asset('frontend/css/modern-ui.css') }}"/>
    <link rel="stylesheet" href="{{ static_asset('frontend/css/odometer.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"   />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ static_asset('frontend/css/swiper-bundle.min.css') }}"/>
    <link rel="stylesheet" href="{{ static_asset('backend/plugins') }}/toastr/toastr.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bitter&family=Roboto:wght@400&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root{
            --primary-color: {{ settings()->primary_color }};
            --bs-white: {{ settings()->text_color }};
            --bs-primary:{{ settings()->primary_color }};
        }
    </style>
</head>
<body>
    @include(active_theme() . '.layouts.navbar')
    @yield('content')
    @include(active_theme() . '.layouts.footer')
    <!-- scripts -->
    <script src="{{ static_asset('frontend/js/jquery.min.js') }}" ></script>
    <script src="{{ static_asset('frontend/js/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ static_asset('frontend/js/swiper-bundle.min.js') }}" ></script>
    <script src="{{ static_asset('frontend/js/jquery.odometer.min.js') }}" ></script>
    <script src="{{ static_asset('frontend/js/theme.js') }}" ></script>
    <script src="{{ static_asset('backend/plugins') }}/toastr/toastr.min.js"></script>
    {!! Toastr::message() !!}

</body>
</html>
