<!-- ================= HERO ================= -->
@php
    $bannerImage = section(\App\Enums\SectionType::BANNER,'banner_theme_3') ?: static_asset('frontend/theme-3/image/frame-3.png');
@endphp
    <section id="top" class="relative overflow-hidden gradient-bg">

        <!-- Decorative Shape -->
        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-emerald-100 rounded-full blur-3xl opacity-40"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-10  pb-20 grid lg:grid-cols-2 gap-12 items-center">

            <!-- Left -->
            <div class="relative z-10">
                <h1 class="text-4xl lg:text-5xl font-black leading-tight">
                    {{ section(\App\Enums\SectionType::BANNER,'title_1') }}
                    <span class="relative block">
                        {{ section(\App\Enums\SectionType::BANNER,'title_2') }}
                        <svg class="absolute w-[80%] lg:w-[70%] h-3 -bottom-0.5 left-0 text-brand-400 opacity-60"
                            viewBox="0 0 100 10" preserveAspectRatio="none">
                            <path d="M0 5 Q 50 15 100 5" stroke="currentColor" stroke-width="4" fill="none" />
                        </svg>
                    </span>

                    <span class="text-emerald-500 italic">
                        {{ section(\App\Enums\SectionType::BANNER,'title_3') }}
                    </span>
                </h1>

                <p class="mt-7 text-gray-500 leading-8 max-w-xl text-base">
                    {{ section(\App\Enums\SectionType::BANNER,'sub_title') }}
                </p>

                <!-- Tracking -->
                <form action="{{ route('tracking.index') }}" method="get"
                    class="mt-6 bg-white shadow-2xl shadow-emerald-100 rounded-2xl p-3 flex flex-col sm:flex-row gap-3 max-w-xl">
                    <div class="h-14 w-full">
                        <input type="text" name="tracking_id" placeholder="{{ __('levels.enter_tracking_id') }}"
                            class="h-full w-full px-5 rounded-xl border border-gray-200 outline-none focus:border-emerald-400">
                    </div>

                    <button type="submit"
                        class="flex items-center cursor-pointer h-14 px-8 rounded-xl bg-emerald-400 hover:bg-emerald-500 text-white font-semibold transition-all duration-300">
                        {{ __('levels.track_now') }}
                    </button>
                </form>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-5 mt-12 max-w-lg">

                    <div class="bg-white rounded-2xl p-5 shadow-lg">
                        <h3 class="text-xl md:text-3xl font-black text-emerald-500">25K+</h3>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">{{ __('levels.delivered_stat') }}</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg">
                        <h3 class="text-xl md:text-3xl font-black text-emerald-500">180+</h3>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">{{ __('levels.cities') }}</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg">
                        <h3 class="text-xl md:text-3xl font-black text-emerald-500">99%</h3>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">{{ __('levels.satisfied') }}</p>
                    </div>

                </div>

            </div>

            <!-- Right -->
            <div class="relative flex justify-center">

                <!-- Background -->
                <div class="absolute w-[450px] h-[450px] rounded-full bg-emerald-100 blur-3xl opacity-40"></div>

                <!-- Illustration -->
                @if($bannerImage)
                    <img src="{{ $bannerImage }}" alt="{{ settings()->name }}"
                        class="relative z-10 w-full max-w-xl floating drop-shadow-2xl">
                @endif

            </div>

        </div>
    </section>
