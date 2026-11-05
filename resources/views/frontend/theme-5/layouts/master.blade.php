<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ settings()->favicon_image }}" type="image/x-icon">
    <title>@yield('title', settings()->name)</title>
    <link rel="stylesheet" href="{{ static_asset('frontend/theme-5/css/output.css') }}">
    <link rel="stylesheet" href="{{ static_asset('backend/css/modern-ui.css') }}">
<!--  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />



  <style>
    html {
      scroll-behavior: smooth;
    }

    .partner-logo {
      transition: filter 0.35s ease, transform 0.35s ease, color 0.35s ease;
      filter: grayscale(1);
    }

    .partner-logo:hover {
      filter: grayscale(0) sepia(0.25) hue-rotate(100deg) saturate(1.1);
      transform: scale(1.05);
    }
  </style>
  <style>
    * {
      -webkit-font-smoothing: antialiased;
    }

    .tab-active-emerald {
      background: #10B981;
      color: white;
      box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .tab-inactive-emerald {
      background: white;
      color: #4B5563;
      border: 1px solid #E5E7EB;
    }

    .tab-inactive-emerald:hover {
      background: #ECFDF5;
      color: #065F46;
      border-color: #A7F3D0;
    }

    .price-row-compact {
      transition: all 0.2s ease;
      background: white;
      border-radius: 1rem;
    }

    .price-row-compact:hover {
      transform: translateY(-1px);
      border-color: #A7F3D0 !important;
      box-shadow: 0 6px 14px rgba(16, 185, 129, 0.08);
    }

    .animate-fade-up {
      animation: fadeUp 0.25s ease-out;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(6px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
    @stack('styles')
</head>
<body class="font-sans text-body-text antialiased bg-white overflow-x-hidden">
    @include(active_theme() . '.layouts.navbar')
    @yield('content')
    @include(active_theme() . '.layouts.footer')

    @stack('scripts')
</body>
</html>
