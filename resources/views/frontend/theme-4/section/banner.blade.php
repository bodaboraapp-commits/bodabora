<!-- HERO -->
@php
    $bannerImage = section(\App\Enums\SectionType::BANNER,'banner_theme_4') ?: static_asset('frontend/theme-4/image/na_january_20.jpg');
@endphp
    <!-- ========================================= -->
    <section id="home" class="relative overflow-hidden pt-14 lg:pt-20">

        <!-- Background -->

        <div class="absolute top-0 left-0 w-80 h-80 bg-hero-bg-overlay-one rounded-full blur-3xl opacity-60"></div>

        <div class="absolute bottom-0 right-0 w-96 h-96 bg-hero-bg-overlay-two rounded-full blur-3xl opacity-40"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Left -->

                <div class="relative z-10">

                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">

                        {{ settings()->name }}

                    </span>

                    <h1
                        class="mt-7 text-4xl lg:text-5xl font-black leading-[1.05] tracking-tight text-section-deep-text">

                        {{ section(\App\Enums\SectionType::BANNER,'title_1') }}
                        <span class="text-section-text">
                            {{ section(\App\Enums\SectionType::BANNER,'title_2') }}
                        </span>

                        {{ section(\App\Enums\SectionType::BANNER,'title_3') }}

                    </h1>

                    <p class="mt-7 text-section-light-text text-lg leading-8 max-w-xl">

                        {{ section(\App\Enums\SectionType::BANNER,'sub_title') }}

                    </p>

                    <!-- Buttons -->

                    <div class="flex flex-wrap gap-5 mt-10">

                        <a href="{{ route('tracking.index') }}"
                            class="cursor-pointer capitalize px-6 py-3 rounded-2xl gb-btn-gradient text-white font-semibold shadow-xl shadow-green-200 hover:scale-105 transition-all duration-300">

                            <i class="fa-solid fa-location-crosshairs mr-1"></i>
                            {{ __('levels.track_now') }}

                        </a>


                    </div>

                </div>

                <!-- Right -->

                <div class="mask-b-from-50% mask-radial-[50%_90%] mask-radial-from-80%">
                    @if($bannerImage)
                        <img src="{{ $bannerImage }}" alt="{{ settings()->name }}" class="w-full rounded-3xl">
                    @endif
                </div>
            </div>

        </div>

    </section>

    <!-- ========================================= -->
