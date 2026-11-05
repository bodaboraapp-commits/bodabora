<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ settings()->favicon_image }}" type="image/x-icon">
    <title>@yield('title', 'We Courier | Modern Courier Service')</title>
    <link rel="stylesheet" href="{{ static_asset('frontend/theme-2/css/output.css') }}">
    <link rel="stylesheet" href="{{ static_asset('backend/css/modern-ui.css') }}">
<!--  -->



    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F0FDF4;
        }

        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(22, 163, 74, 0.15);
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Hero Illustration Animation */
        .bike-float {
            animation: bikeFloat 6s ease-in-out infinite;
        }

        .cloud-move {
            animation: cloudMove 15s linear infinite;
        }

        .wheel-spin {
            transform-origin: center;
            animation: spin 2s linear infinite;
        }

        @keyframes bikeFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes cloudMove {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        /* Step connecting line */
        .step-container {
            position: relative;
        }

        .step-container::after {
            content: '';
            position: absolute;
            top: 2.5rem;
            left: 50%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #16A34A 50%, transparent 50%);
            background-size: 10px 10px;
            z-index: 0;
            opacity: 0.3;
        }

        .step-container:last-child::after {
            display: none;
        }

        @media (max-width: 768px) {
            .step-container::after {
                display: none;
            }
        }

        .blob-bg {
            position: absolute;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.5;
            border-radius: 50%;
        }
    </style>
    <style>
        .tab-active {
            background: #16A34A;
            color: white;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);
            border-color: transparent;
        }

        .tab-inactive {
            background: white;
            color: #6B7280;
            border: 1px solid #E5E7EB;
            transition: all 0.2s ease;
        }

        .tab-inactive:hover {
            background: #F9FAFB;
            color: #111827;
            border-color: #D1D5DB;
        }

        .price-row {
            transition: all 0.2s ease;
        }

        .price-row:hover {
            transform: translateY(-2px);
            border-color: #DCFCE7;
            box-shadow: 0 8px 20px -6px rgba(22, 163, 74, 0.1);
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }
    </style>
    <style>
        /* All cards have identical container */
        .testimonial-card {
            transition: transform 0.4s cubic-bezier(0.2, 0.95, 0.4, 1.05), opacity 0.4s ease, filter 0.4s ease;
            cursor: pointer;
        }

        /* Clean modern SaaS card inner */
        .card-inner {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            padding: 1.75rem;
            box-shadow: 0 10px 30px -10px rgba(22, 163, 74, 0.1);
            border: 1px solid rgba(22, 163, 74, 0.1);
            /* height: 100%; */
            /* min-height: 420px; */
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.2, 0.95, 0.4, 1.05);
            position: relative;
            overflow: hidden;
        }

        /* Gradient border effect for center card */
        .card-inner.gradient-border {
            background: white;
            box-shadow: 0 20px 40px -10px rgba(22, 163, 74, 0.2);
        }

        .card-inner.gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.5rem;
            padding: 2px;
            background: linear-gradient(135deg, #4ADE80, #16A34A, #14532D);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        /* Responsive height */
        @media (max-width: 768px) {
            .card-inner {
                min-height: 360px;
                padding: 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .card-inner {
                min-height: 300px;
                padding: 1.25rem;
            }
        }

        /* Zoom animations */
        .testimonial-card.zoom-in {
            transform: scale(1.08);
            z-index: 50;
        }

        .testimonial-card.zoom-out {
            transform: scale(0.88);
            opacity: 0.6;
            filter: blur(1px);
        }

        /* Default center zoomed in state */
        .testimonial-card.main-card.initial-zoom {
            transform: scale(1.00);
            z-index: 50;
        }

        /* Floating quote animation */
        .floating-quote {
            animation: floatSlow 5s ease-in-out infinite;
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* Micro cards zoom effect */
        .micro-card {
            transition: all 0.3s cubic-bezier(0.2, 0.95, 0.4, 1.05);
            cursor: pointer;
        }

        .micro-card.micro-zoom-in {
            transform: scale(1.05);
            background: white;
            box-shadow: 0 15px 25px -10px rgba(22, 163, 74, 0.2);
            border-color: #16A34A;
        }

        .micro-card.micro-zoom-out {
            transform: scale(0.94);
            opacity: 0.5;
            filter: blur(1px);
        }
    </style>
    @stack('styles')
</head>
<body class="text-gray-800 antialiased overflow-x-hidden selection:bg-brand-400 selection:text-white">
    @include(active_theme() . '.layouts.navbar')
    @yield('content')
    @include(active_theme() . '.layouts.footer')

    @stack('scripts')
</body>
</html>
