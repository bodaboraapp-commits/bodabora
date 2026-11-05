<!-- ================= GPS TRACKING ================= -->
    <section class="py-24 overflow-hidden">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center">

            <!-- Content -->
            <div>

                <span class="inline-block px-4 py-2 rounded-full bg-emerald-100 text-emerald-600 text-sm font-semibold">
                    {{ __('levels.live_parcel_tracking') }}
                </span>

                <h2 class="text-4xl lg:text-5xl font-black mt-6 leading-tight">
                    {{ __('levels.track_your_shipment') }}
                </h2>

                <p class="mt-7 text-gray-600 leading-8">
                    {{ __('levels.tracking_dashboard_intro') }}
                </p>

                <a href="{{ route('tracking.index') }}"
                    class="mt-8 inline-flex px-7 py-4 rounded-2xl bg-emerald-400 hover:bg-emerald-500 text-white font-semibold transition">
                    {{ __('levels.learn_more') }}
                </a>

            </div>

            <!-- Image -->
            <div class="relative flex items-center justify-center">

                <!-- Background Glow -->
                <div class="absolute inset-0 bg-emerald-100 blur-3xl rounded-full opacity-30"></div>

                <!-- Main Image -->
                <img src="{{ section(\App\Enums\SectionType::GALLERY,'gallery_image_3') ?: static_asset('frontend/theme-5/image/merchant.jpg') }}" class="relative z-10 w-full floating" alt="{{ __('levels.live_parcel_tracking') }}">

                <!-- Locator -->
                <div class="absolute inset-0 flex items-center justify-center z-20 floating">
                    <!-- Ping Animation -->
                    <span class="absolute w-14 h-14 bg-emerald-400 rounded-full animate-ping opacity-40">
                    </span>

                    <!-- Locator SVG -->
                    <div class="w-14 h-14 rounded-full flex items-center justify-center shadow-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z" />
                        </svg>
                    </div>

                </div>

            </div>

        </div>

    </section>
