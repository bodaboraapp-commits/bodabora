<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ settings()->favicon_image }}" type="image/x-icon">
    <title>@yield('title', settings()->name)</title>
    <meta name="description" content="@yield('meta_description', 'The fastest courier platform with every feature you need to start, run and grow your courier service.')">
    <link rel="stylesheet" href="{{ static_asset('frontend/theme-3/css/output.css') }}">
    <link rel="stylesheet" href="{{ static_asset('frontend/theme-3/css/blog-content.css') }}">
    <link rel="stylesheet" href="{{ static_asset('backend/css/modern-ui.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
            /* Sticky header h-20 (5rem) + comfortable gap below */
            scroll-padding-top: 5.5rem;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            .floating {
                animation: none;
            }
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        #top,
        #pricing,
        #calculate {
            scroll-margin-top: 5.5rem;
        }

        .floating {
            animation: float 4s ease-in-out infinite;
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



        .gradient-bg {
            background:
                radial-gradient(circle at top left, #dff5e7 0%, transparent 30%),
                radial-gradient(circle at bottom right, #dff5e7 0%, transparent 30%),
                #ffffff;
        }
    </style>
    <style>
        /*  Truck slight floating (running feeling) */
        .float-animation {
            animation: truckMove 1.8s ease-in-out infinite;
        }

        @keyframes truckMove {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        /* CLOUD BASE STYLE */
        .cloud {
            position: absolute;
            width: 180px;
            height: auto;
        }

        /*  CLOUD 1 */
        .cloud1 {
            top: 60px;
            animation: moveCloud1 22s linear infinite;
        }

        /*  CLOUD 2 */
        .cloud2 {
            top: 180px;
            width: 220px;
            animation: moveCloud2 30s linear infinite;
        }

        /*  CLOUD 3 */
        .cloud3 {
            top: 320px;
            width: 150px;
            animation: moveCloud3 18s linear infinite;
        }

        /*  CLOUD MOVEMENT */
        @keyframes moveCloud1 {
            0% {
                transform: translateX(120vw);
            }

            100% {
                transform: translateX(-200px);
            }
        }

        @keyframes moveCloud2 {
            0% {
                transform: translateX(140vw);
            }

            100% {
                transform: translateX(-250px);
            }
        }

        @keyframes moveCloud3 {
            0% {
                transform: translateX(110vw);
            }

            100% {
                transform: translateX(-180px);
            }
        }

        .road-lines {
            position: absolute;
            bottom: 0px;
            left: 0;
            right: 0;
            width: 200%;
            height: 5px;
            background-image: repeating-linear-gradient(to right,
                    #10b981 0px,
                    #10b981 20px,
                    transparent 15px,
                    transparent 30px);
            animation: roadMove 1s linear infinite;
            opacity: 0.3;
        }

        @keyframes roadMove {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-30px);
            }
        }
    </style>
    <style>
        .gradient-soft {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        }

        .tab-rail {
            display: flex;
            align-items: stretch;
            gap: 0.25rem;
            padding: 0.35rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgb(209 250 229);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9), 0 1px 2px rgba(23, 59, 53, 0.04);
            scrollbar-width: thin;
            scrollbar-color: rgb(167 243 208) transparent;
        }

        .tab-rail::-webkit-scrollbar {
            height: 6px;
        }

        .tab-rail::-webkit-scrollbar-thumb {
            background: rgb(167 243 208);
            border-radius: 999px;
        }

        .tab-btn {
            min-width: 0;
        }

        .tab-active {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35), 0 1px 0 rgba(255, 255, 255, 0.2) inset;
        }

        .tab-inactive {
            background: transparent;
            color: #173b35;
            border: 1px solid transparent;
            transition: background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        .tab-inactive:hover {
            background: rgba(236, 253, 245, 0.95);
            color: #16a34a;
        }

        .tab-btn:focus-visible {
            outline: 2px solid #34d399;
            outline-offset: 2px;
        }

        .price-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .price-card:hover {
            transform: translateY(-4px);
            border-color: #6ee7b7;
            box-shadow: 0 12px 28px -8px rgba(16, 185, 129, 0.18);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FAFAFA] text-[#173B35] overflow-x-hidden">
    @include(active_theme() . '.layouts.navbar')
    @yield('content')
    @include(active_theme() . '.layouts.footer')

    @stack('scripts')
</body>
</html>
