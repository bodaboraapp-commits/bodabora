<!DOCTYPE html>
<html lang="en" class="scroll-smooth scroll-pt-24">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ settings()->favicon_image }}" type="image/x-icon">
    <title>@yield('title', settings()->name)</title>
    <link rel="stylesheet" href="{{ static_asset('frontend/theme-4/css/output.css') }}">
    <link rel="stylesheet" href="{{ static_asset('backend/css/modern-ui.css') }}">
<!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #F6FBF7;
            overflow-x: hidden;
        }

        .floating {
            animation: float 5s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* Marketing / content cards: stronger lift on hover */
        .gb-card-lift {
            transition: all .35s ease;
        }

        .gb-card-lift:hover {
            transform: translateY(-10px);
        }

        /* Primary CTA + logo tile */
        .gb-btn-gradient {
            background: linear-gradient(135deg, #22C55E 0%, #15803D 100%);
        }

        /* Soft mint panels (icons, secondary surfaces) */
        .gb-surface-soft {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        }

        /* Large green feature bands (CTA, featured service card) */
        .gb-surface-hero {
            background: linear-gradient(135deg, #16A34A 0%, #22C55E 50%, #4ADE80 100%);
        }

        [x-cloak] {
            display: none !important;
        }

        /* Embedded pricing section: tab states (not the FAQ Alpine “active”) */
        .pricing-tab-btn.pricing-tab-active {
            background: linear-gradient(135deg, #22C55E 0%, #15803D 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 14px rgba(22, 163, 74, 0.35);
        }

        .pricing-tab-btn.pricing-tab-inactive {
            background: white;
            color: #374151;
            border: 1px solid #DCFCE7;
            transition: all 0.2s ease;
        }

        .pricing-tab-btn.pricing-tab-inactive:hover {
            background: #ECFDF5;
            color: #15803D;
            border-color: #86EFAC;
        }

        .gb-pricing-tile {
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .gb-pricing-tile:hover {
            transform: translateY(-4px);
            border-color: #86EFAC;
            box-shadow: 0 12px 28px -8px rgba(22, 163, 74, 0.18);
        }

        .pricing-tab-fade-in {
            animation: pricingTabFade 0.25s ease-out;
        }

        @keyframes pricingTabFade {
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
<body id="top" class="text-body-text">
    @include(active_theme() . '.layouts.navbar')
    @yield('content')
    @include(active_theme() . '.layouts.footer')
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
